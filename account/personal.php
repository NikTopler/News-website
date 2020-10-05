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

            <div class="main-content personal">

                <div class="container personal">
                    <section class="header">   
                        <div class="h1">
                            <h1>Personal Information</h1>
                        </div>
                        <div class="text">
                            <p>Basic info, such as your name, photo, country, that you use on the site</p>
                        </div>
                    </section>
                    <section class="personal">
                        <header>
                            <h1>Profile</h1>
                            <p>Profile News articles will be displayed on the front page, based on your country</p>
                        </header>
                        <div class="info photo" onclick="showProfileImg()">
                            <div class="line"></div>
                            <div class="title">
                                <h3>Photo</h3>
                            </div>
                            <div class="text"><p>Add a photo to personalize your account</p></div>
                            <div class="image">
                                <?php 
                                    if($_SESSION['profile_choice'] == 0) 
                                        echo ('<div class="img medium" ><img src="../'.$_SESSION['profile_img'].'" class="imga"></div>');
                                    else if($_SESSION['profile_choice'] == 1) 
                                        echo ('<div class="img medium" style="background-color: '.$_SESSION['profile_color'].';">
                                                    <div class="letter">
                                                        <span>'.$_SESSION['letter'].'</span>
                                                    </div>
                                                </div>');
                                    else if($_SESSION['profile_choice'] == 2) 
                                        echo ('<div class="img medium" ><img src="'.$_SESSION['google_profile_img'].'" class="imga"></div>');
                                    else if($_SESSION['profile_choice'] == 3) 
                                        echo ('<div class="img medium"><img src="'.$_SESSION['facebook_profile_img'].'" class="imga"></div>');
                                    else if($_SESSION['profile_choice'] == 4) 
                                        echo ('<div class="img medium"><img src="'.$_SESSION['github_profile_img'].'" class="imga"></div>');
                                ?>
                            </div>
                        </div>
                        <div class="info" onclick="openLinks('/account/changeName.php')">
                            <div class="line"></div>
                            <div class="title">
                                <h3>Name</h3>
                            </div>
                            <div class="text">
                                <p>
                                    <?php    
                                        if(isset($_SESSION['name']) && isset($_SESSION['surname'])) echo $_SESSION['name'].' '.$_SESSION['surname'];
                                        else if(isset($_SESSION['name'])) echo $_SESSION['name'];
                                        else if(isset($_SESSION['surname'])) echo ' '.$_SESSION['surname'];
                                        else echo 'Not set'
                                    ?> 
                                </p>
                            </div>
                            <div class="arrow">
                                <i class="far fa-angle-right fa-lg"></i>
                            </div>
                        </div>
                        <div class="info" onclick="openLinks('/account/changeGender.php')">
                            <div class="line"></div>
                            <div class="title">
                                <h3>Gender</h3>
                            </div>
                            <div class="text">
                                <p>
                                    <?php    
                                        if(isset($_SESSION['gender'])) echo $_SESSION['gender'];
                                        else echo 'Not set'
                                    ?> 
                                </p>
                            </div>
                            <div class="arrow">
                                <i class="far fa-angle-right fa-lg"></i>
                            </div>
                        </div>
                        <div class="info" onclick="openLinks('/account/changeCountry.php?cou=<?php if(isset($_SESSION['country'])) echo $_SESSION['country'][1]?>')">
                            <div class="line"></div>
                            <div class="title">
                                <h3>Country</h3>
                            </div>
                            <div class="text">
                                <p>
                                    <?php    
                                        if(isset($_SESSION['country'])) echo $_SESSION['country'][0];
                                        else echo 'Not set'
                                    ?> 
                                </p>
                            </div>
                            <div class="arrow">
                                <i class="far fa-angle-right fa-lg"></i>
                            </div>
                        </div>
                        <div class="info psw" onclick="openLinks('/account/changePassword.php')">
                            <div class="line"></div>
                            <div class="title">
                                <h3>Password</h3>
                            </div>
                            <div class="text psw">
                                <div>
                                    <p>
                                        <?php    
                                            echo $_SESSION['password-set']
                                        ?>
                                    </p>
                                </div>
                                <div class="time">
                                    <span>
                                        <?php    
                                            if($_SESSION['password-set'] == 'Not set') echo 'You need to set up password, if you ever decide using standard sign in system';
                                            else {
                                                $d = date('dmYhms', $_SESSION['password_change']);
                                                $date = substr($d, 0, 2).'-'.substr($d, 2, 2).'-'.substr($d, 4, 4).' '.substr($d, 8, 2).':'.substr($d, 10, 2).':'.substr($d, 12, 2);
                                                echo $date;
                                            }
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="arrow">
                                <i class="far fa-angle-right fa-lg"></i>
                            </div>
                        </div>

                    </section>

                    <article>
                        <div class="info">
                            <div class="title">
                                <h3>Email</h3>
                            </div>
                            <div class="text">
                                <p>
                                    <?php    
                                        echo $_SESSION['email'];
                                    ?> 
                                </p>
                            </div>
                        </div>
                    </article>
                </div>

            </div>
        </main>
        <?php  include '../add-ons/profileImg.php' ?>

        <div class="fixed" id="overlay"></div>
    </body>
</html>