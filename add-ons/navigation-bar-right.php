<div class="nav-right-side" id="navigation-bar-right">
        <a href="#" class="login link  <?php if(isset($_SESSION['id'])) echo 'disable'?>" id="login-button" onclick="manageLoginOptions()">Log in</a>

        <div class="outter-container border-radius-50 pointer <?php if(!isset($_SESSION['id'])) echo 'disable'?>" id="outter-container">
            <div>
                <?php 
                    $path = '../';
                    if(strpos($_SERVER['REQUEST_URI'], 'search') || strpos($_SERVER['REQUEST_URI'], 'headlines')) $path = '';


                    if(!strpos($_SERVER['REQUEST_URI'], 'change')) $str = 'onclick="manageExtraProfileOptions()"'; 
                    else $str = '';

                    if($_SESSION['profile_choice'] == 0) 
                        echo ('<div class="img small" '.$str.'><img src="'.$path.$_SESSION['profile_img'].'" class="imga"></div>');
                    else if($_SESSION['profile_choice'] == 1) 
                        echo ('<div class="img small" '.$str.' style="background-color: '.$_SESSION['profile_color'].';">
                                    <div class="letter">
                                        <span>'.$_SESSION['letter'].'</span>
                                    </div>
                                </div>');
                    else if($_SESSION['profile_choice'] == 2) 
                        echo ('<div class="img small" '.$str.'><img src="'.$_SESSION['google_profile_img'].'" class="imga"></div>');
                    else if($_SESSION['profile_choice'] == 3) 
                        echo ('<div class="img small"'.$str.'><img src="'.$_SESSION['facebook_profile_img'].'" class="imga"></div>');
                    else if($_SESSION['profile_choice'] == 4) 
                        echo ('<div class="img small" '.$str.'><img src="'.$_SESSION['github_profile_img'].'" class="imga"></div>');

                ?>
                
            </div>
            <span class="tooltiptext tooltiptextTop90">
                <div><strong>Personal Information</strong></div>
                <div class=" <?php if(!isset($_SESSION['name']) && !isset($_SESSION['surname'])) echo 'disable'?> ">
                    <span class="tooltiptext-name">
                        <?php echo $_SESSION['name'].' '.$_SESSION['surname'];?>
                    </span>
                </div>
                <div>
                    <span class="tooltiptext-name">
                        <?php echo $_SESSION['email']?>
                    </span>
                </div>
            </span>
        </div>
    </div>

    <aside class="profile-extra-options absolute disable" id="profile-extra-options">
        <div class="top-div">
            <div class="img-container">
                <div class="img-middle">
                    <div>
                        <?php 
                            $path = '../';
                            if(strpos($_SERVER['REQUEST_URI'], 'search') || strpos($_SERVER['REQUEST_URI'], 'headlines')) $path = '';
                        
                            if($_SESSION['profile_choice'] == 0) 
                                echo ('<div class="img big" onclick="openLinks(\'/account/home.php\')" ><img src="'.$path.$_SESSION['profile_img'].'" class="imga"></div>');
                            else if($_SESSION['profile_choice'] == 1) 
                                echo ('<div class="img big" onclick="openLinks(\'/account/home.php\')" style="background-color: '.$_SESSION['profile_color'].';">
                                            <div class="letter">
                                                <span>'.$_SESSION['letter'].'</span>
                                            </div>
                                        </div>');
                            else if($_SESSION['profile_choice'] == 2) 
                                echo ('<div class="img big" onclick="openLinks(\'/account/home.php\')"><img src="'.$_SESSION['google_profile_img'].'" class="imga"></div>');
                            else if($_SESSION['profile_choice'] == 3) 
                                echo ('<div class="img big" onclick="openLinks(\'/account/home.php\')"><img src="'.$_SESSION['facebook_profile_img'].'" class="imga"></div>');
                            else if($_SESSION['profile_choice'] == 4) 
                                echo ('<div class="img big" onclick="openLinks(\'/account/home.php\')"><img src="'.$_SESSION['github_profile_img'].'" class="imga"></div>');
                        ?>
                    </div>
                    <div class="camera-container" onclick="showProfileImg()">
                        <i class="far fa-camera"></i>
                    </div>
                </div>
            </div>
            <div class="full-name <?php if(!isset($_SESSION['name']) && !isset($_SESSION['surname'])) echo 'disable'?>">
                <span>
                    <?php echo $_SESSION['name'].' '.$_SESSION['surname']; ?>
                </span>
            </div>
            <div class="email">
                <span><?php echo $_SESSION['email']?></span>
            </div>
            <div class="manage-button">
                <?php 
                
                    if(strpos($_SERVER['REQUEST_URI'], 'account')) 
                        echo '<div class="container" onclick="openLinks(\'/headlines.php\')">
                                <span>
                                    Browse latest news articles
                                </span>
                            </div>';
                    else 
                        echo '<div class="container" onclick="openLinks(\'/account/home.php\')">
                                <span>
                                    Manage your account
                                </span>
                            </div>';
                
                ?>    
            </div>

        </div>
        <div class="middle-div">
            <div class="container" <?php if($_SESSION['googleID'] == 0) echo 'onclick="logOut(\'#login\')"' ?>>
               <div class="google">
                    <div>
                        <i class="fab fa-google icon"></i>
                    </div>
                    <span>
                        <?php 
                            if($_SESSION['googleID'] == 0) echo 'Sign in with Google'; 
                            else echo 'Signed in'; 
                        ?>
                    </span>
               </div>
            </div>
            <div class="container" <?php if($_SESSION['facebookID'] == 0) echo 'onclick="logOut(\'#login\')"' ?>>
                <div class="facebook">
                    <div>
                        <i class="fab fa-facebook icon"></i>
                    </div>
                    <span>
                        <?php 
                            if($_SESSION['facebookID'] == 0) echo 'Sign in with Facebook'; 
                            else echo 'Signed in'; 
                        ?>
                    </span>
                </div>
            </div>
            <div class="container" <?php if($_SESSION['githubID'] == 0) echo 'onclick="logOut(\'#login\')"' ?>>
                <div class="github">
                    <div>
                        <i class="fab fa-github icon"></i>
                    </div>
                    <span>
                        <?php 
                            if($_SESSION['githubID'] == 0) echo 'Sign in with Github'; 
                            else echo 'Signed in'; 
                        ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="bottom-div">
            <div class="sign-out">
                <div class="button-container" onclick="<?php if(strpos($_SERVER['REQUEST_URI'], 'account')) echo 'logout(\'\')'; else echo 'logOut(\'\')';?>">
                    <span>
                        Sign out
                    </span>
                </div>
            </div>
            <div class="footer">
                <div class="container">
                   <div class="inner-container">
                        <span>About</span>
                        <span>Settings</span>
                   </div>
                </div>
            </div>
        </div>
    </aside>