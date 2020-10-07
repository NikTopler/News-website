<?php 
    include 'add-ons/head.php'; 
    include_once '../include/db.inc.php';
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
                            Welcome to Trending Section
                        </h1>
                    </div>
                    <div class="text">
                        <p>
                            Have full controll over trending page
                        </p>
                    </div>
                <div class="trending-main-container">
                    <section class="all">
                        <div class="h1">
                            <h1>
                                All News
                            </h1>
                        </div>
                        <div class="text">
                            <p>
                                Here are all news articles that are not included in trending
                            </p>
                        </div>
                            <article class="table" onclick="">
                                    <div class="col">
                                        <div class="cell">
                                            <h1>Author</h1>
                                        </div>
                                        <div  class="cell">
                                            <h1>Title</h1>
                                        </div>
                                        <div class="cell">
                                            <h1>Text</h1>
                                        </div>
                                        <div class="cell">
                                            <h1>Source</h1>
                                        </div>
                                    </div>

                                    <?php 
                                
                                        class generateNews extends Dbh {

                                            public function generate() {

                                                $sql = "SELECT * FROM news LIMIT 200";
                                                $stmt = $this->connect()->prepare($sql);
                                                $stmt->execute();
                                                $row = $stmt->fetch();
                                                while($row = $stmt->fetch()) {
                                                    $author = '/';
                                                    $title = '/';
                                                    $text = '/';

                                                    if($row['author'] != null) $author = $row['author'];

                                                    if($row['title'] != null) $title = $row['title'];

                                                    if($row['text'] != null) $text = $row['text'];

                                                    if($this->checkIfNewsIsInTrending($row['id']) == 'no') {

                                                        $source = $this->getSource($row['source_id']);

                                                        echo '<div class="col" onclick="showTrendingOptions(this)">';
                                                            echo '<div class="cell">';
                                                                echo '<span>'.$author.'</span>';
                                                                echo '<span class="disable id all">'.$row['id'].'</span>';
                                                            echo '</div>';
                                                            echo '<div class="cell">';
                                                                echo '<span>'.$title.'</span>';
                                                            echo '</div>';
                                                            echo '<div class="cell">';
                                                                echo '<span>'.$text.'</span>';
                                                            echo '</div>';
                                                            echo '<div class="cell">';
                                                                echo '<span>'.$source.'</span>';
                                                            echo '</div>';
                                                        echo '</div>';
                                                    }
                                                }    
                                            }
                                            public function getSource($id) {
                                                $sql = "SELECT * FROM sources WHERE id = ?";
                                                $stmt = $this->connect()->prepare($sql);
                                                $stmt->execute([$id]);
                                                $row = $stmt->fetch();
                                                if($row['name'] == null) return 'No source';
                                                else return $row['name'];
                                            }

                                            public function checkIfNewsIsInTrending($id) {
                                                $sql = "SELECT * FROM trending WHERE news_id = ?";
                                                $stmt = $this->connect()->prepare($sql);
                                                $stmt->execute([$id]);
                                                $row = $stmt->fetch();
                                                if($row) return 'yes';
                                                else return 'no';
                                            }

                                        }

                                        $generateObj = new generateNews();
                                        $generateObj->generate();

                                    ?>
                            </article>
                    </section>
                    <section class="trending">
                        <div class="h1">
                            <h1>
                                Trending Page
                            </h1>
                        </div>
                            <article class="table" onclick="">
                                    <div class="col">
                                        <div class="cell">
                                            <h1>Author</h1>
                                        </div>
                                        <div  class="cell">
                                            <h1>Title</h1>
                                        </div>
                                        <div class="cell">
                                            <h1>Text</h1>
                                        </div>
                                        <div class="cell">
                                            <h1>Source</h1>
                                        </div>
                                    </div>

                                    <?php 
                                    
                                        class generateTrendingNews extends Dbh {
                                            
                                            public function generate() {
                                                $sql = "SELECT n.id, n.author,n.title,n.text,n.source_id FROM trending t INNER JOIN news n ON n.id = t.news_id";
                                                $stmt = $this->connect()->prepare($sql);
                                                $stmt->execute();
                                                while($row = $stmt->fetch()) {
                                                    $author = '/';
                                                    $title = '/';
                                                    $text = '/';

                                                    if($row['author'] != null) $author = $row['author'];

                                                    if($row['title'] != null) $title = $row['title'];

                                                    if($row['text'] != null) $text = $row['text'];

                                                        $source = $this->getSource($row['source_id']);

                                                        echo '<div class="col" onclick="showTrendingOptions(this)">';
                                                            echo '<div class="cell">';
                                                                echo '<span>'.$author.'</span>';
                                                                echo '<span class="disable id trending">'.$row['id'].'</span>';
                                                            echo '</div>';
                                                            echo '<div class="cell">';
                                                                echo '<span>'.$title.'</span>';
                                                            echo '</div>';
                                                            echo '<div class="cell">';
                                                                echo '<span>'.$text.'</span>';
                                                            echo '</div>';
                                                            echo '<div class="cell">';
                                                                echo '<span>'.$source.'</span>';
                                                            echo '</div>';
                                                        echo '</div>';
                                                }    
                                            }
                                            public function getSource($id) {
                                                $sql = "SELECT * FROM sources WHERE id = ?";
                                                $stmt = $this->connect()->prepare($sql);
                                                $stmt->execute([$id]);
                                                $row = $stmt->fetch();
                                                if($row['name'] == null) return 'No source';
                                                else return $row['name'];
                                            }
                                        }

                                        $generateTrendingObj = new generateTrendingNews();
                                        $generateTrendingObj->generate();

                                    ?>
                            </article>
                    </section>
                </div>
            </div>
        </main>
    <?php  include '../add-ons/profileImg.php' ?>
    <div class="fixed" id="overlay"></div>

    </body>
</html>