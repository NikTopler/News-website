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
                
                <?php include 'add-ons/footer.php' ?>

            </div>
        </main>

    </body>
</html>