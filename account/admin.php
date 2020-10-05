<?php 
    include 'add-ons/head.php'; 
    if($_SESSION['admin'] == 'no') header("location:../headlines.php");
?>

<body>

    <nav class="account">
        <div class="left">
            <div class="container">
                <div class="logo">
                    <a href="">Fews Account</a>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="main-container">
                <?php include '../add-ons/navigation-bar-right.php' ?>
            </div>
        </div>
    </nav>
    <main>
        <?php include 'add-ons/side-bar.php' ?>

        <div class="main-content">

            <div class="container">
                <section class="header">
                    <div class="h1">
                        <h1>
                            Welcome to the Admin Panel
                        </h1>
                    </div>
                    <div class="text">
                        <p>
                            Manage user privileges
                        </p>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Country</th>
                                <th scope="col">Status</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                include_once '../include/db.inc.php';

                                class generateUsers extends Dbh {
                                    
                                    public function generate() {
                                        $sql = "SELECT * FROM users";
                                        $stmt = $this->connect()->prepare($sql);
                                        $stmt->execute();
                                        $row = $stmt->fetch();
                                        while($row = $stmt->fetch()) {

                                            if($_SESSION['email'] != $row['email']) {
                                                echo '<tr>';
                                                    echo '<td>';
                                                        $name = 'No name set';
                                                        if(isset($row['name'])) $name = $row['name'];
                                                        if(isset($row['surname'])) $name = $name.' '.$row['surname'];
                                                        echo $name;
                                                    echo '</td>';
                                                    echo '<td>';
                                                        echo $row['email'];
                                                    echo '</td>';
                                                    echo '<td>';
                                                        echo $this->getCountryNameWithID($row['country_id']);
                                                    echo '</td>';
                                                    echo '<td>';
                                                        if($this->checkIfIsUserAdmin($row['id']) == 'yes' ) $admin = 'admin';
                                                        else $admin = 'user';
                                                        echo $admin;
                                                    echo '</td>';
                                                    echo '<td>';
                                                        if($admin == 'admin') {
                                                            $add = 'disable';
                                                            $remove = '';
                                                        } else {
                                                            $remove = 'disable';
                                                            $add = '';
                                                        }
                                                        echo '<div class="plus-icon-container '.$add.'" onclick="addAdmin(this)">
                                                                    <div>
                                                                        <i class="far fa-plus"></i>
                                                                    </div>
                                                                    <span class="tooltiptext tooltiptextTop130">Add</span>
                            
                                                                </div>
                                                                <div class="trash-icon-container '.$remove.'" onclick="removeAdmin(this)">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                    <span class="tooltiptext tooltiptextTop130">Remove</span>
                                                                </div>';
                                                    echo '</td>';
                                                echo '</tr>';
                                            }

                                        }
                                    }

                                    public function getCountryNameWithID($id) {
                                        $sql = "SELECT * FROM countries WHERE id = ?";
                                        $stmt = $this->connect()->prepare($sql);
                                        $stmt->execute([$id]);
                                        $row = $stmt->fetch();
                                        return $row['name'];
                                    }
                                    public function checkIfIsUserAdmin($id) {
                                        $sql = "SELECT * FROM admins WHERE user_id = ?";
                                        $stmt = $this->connect()->prepare($sql);
                                        $stmt->execute([$id]);
                                        $row = $stmt->fetch();
                                        if($row) return 'yes';
                                        else return 'no';
                                    }

                                }

                                $generateObj = new generateUsers();
                                $generateObj->generate();

                            ?>
                        </tbody>
                    </table>
                </section>
            </div>

        </div>

    </main>

</body>

</html>