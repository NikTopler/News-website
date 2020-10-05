<?php include 'add-ons/head.php' ?>

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
                        <div class="img-container"> 
                            <?php 
                                $path = '../';
                                if(strpos($_SERVER['REQUEST_URI'], 'search') || strpos($_SERVER['REQUEST_URI'], 'headlines')) $path = '';
                            
                                if($_SESSION['profile_choice'] == 0) 
                                    echo ('<div class="img xxl" onclick="changeProfileImg()" ><img src="'.$path.$_SESSION['profile_img'].'" class="imga"></div>');
                                else if($_SESSION['profile_choice'] == 1) 
                                    echo ('<div class="img xxl" onclick="changeProfileImg()" style="background-color: '.$_SESSION['profile_color'].';">
                                                <div class="letter">
                                                    <span>'.$_SESSION['letter'].'</span>
                                                </div>
                                            </div>');
                                else if($_SESSION['profile_choice'] == 2) 
                                    echo ('<div class="img xxl" onclick="changeProfileImg()"><img src="'.$_SESSION['google_profile_img'].'" class="imga"></div>');
                                else if($_SESSION['profile_choice'] == 3) 
                                    echo ('<div class="img xxl" onclick="changeProfileImg()"><img src="'.$_SESSION['facebook_profile_img'].'" class="imga"></div>');
                                else if($_SESSION['profile_choice'] == 4) 
                                    echo ('<div class="img xxl" onclick="changeProfileImg()"><img src="'.$_SESSION['github_profile_img'].'" class="imga"></div>');
                            ?>
                            <figure>
                                <div><i class="fas fa-camera fa-lg" aria-hidden="true"></i></div>
                            </figure>
                        </div>
                        <div class="h1">
                            <h1>
                                <?php 
                                    if(isset($_SESSION['name']) || isset($_SESSION['surname'])) echo 'Welcome, ';
                                    if(isset($_SESSION['name'])) echo $_SESSION['name'];
                                    if(isset($_SESSION['surname'])) echo ' '.$_SESSION['surname'];
                                ?>
                            </h1>
                        </div>
                        <div class="text">
                            <p>
                                Manage your info, privacy and security
                            </p>
                        </div>
                    </section>
                    <section>
                        <div class="section-main-container">
                            <div class="section-container">
                                <div class="content">
                                    <h1>Personal Information</h1>
                                    <p>
                                        See & update account details. <br>
                                        <strong>Note: </strong>Some personal information can change the way website works.
                                    </p>
                                </div>
                                <div class="button" onclick="openLinks('/account/personal.php')">
                                    <a href="#">Manage your Personal Information</a>
                                </div>
                            </div>
                            <div class="section-container">
                                <div class="content">
                                    <h1>Settings</h1>
                                    <p>
                                        Customize your account based on your prefrences.
                                    </p>
                                </div>
                                <div class="button" onclick="openLinks('/account/settings.php')">
                                    <a href="#">Open Settings</a>
                                </div>
                            </div>
                        </div>
                        <?php 
                        
                        if($_SESSION['admin'] != 'no')
                            echo '<div class="section-main-container">
                                    <div class="section-container">
                                        <div class="content">
                                            <h1>Admin</h1>
                                            <p>
                                                See & add & edit users with admin role. <br>
                                                <strong>Note: </strong> this page is only for website moderators.
                                            </p>
                                        </div>
                                        <div class="button" onclick="openLinks(\'/account/admin.php\')">
                                            <a href="#">Manage Admins</a>
                                        </div>
                                    </div>
                                    <div class="section-container">
                                        <div class="content">
                                            <h1>Trending Section</h1>
                                            <p>
                                                Select news articles, that are going to be featured in the trending section.
                                            </p>
                                        </div>
                                        <div class="button" onclick="openLinks(\'/account/trending.php\')">
                                            <a href="#">Edit Trending section</a>
                                        </div>
                                    </div>
                                </div>';
                        
                        ?>
                    </section>
                </div>
            </div>
        </main>
        <div class="fixed" id="overlay"></div>

    </body>
</html>