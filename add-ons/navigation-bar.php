<nav class="navigation-bar grid align-center fixed active" id="navigation-bar">

    <div class="nav-left-side flex align-center" id="navigation-bar-left">
        <figure class="menu-icon flex relative align-center justify-center border-radius-50 pointer"
            onclick="manageSideMenu()" id="menu-burger-button">
            <div class="menu-burger-icon">
            </div>
        </figure>
        <a href="#" onclick="openLinks('headlines.php')" class="logo">Fews</a>
    </div>

    <div class="nav-search flex align-center justify-center relative" id="navigation-bar-middle">
        <div class="main-search-bar-input-div grid" id="main-search-bar-input-div">
            <input type="text" class="main-search-input" id="main-search-input"
                placeholder="Search for latest news articles" autocomplete="off" value="">
            <figure class="search-icon-figure flex align-center justify-center relative" id="search-icon-figure">
                <a href="#" class="search-icon flex align-center justify-center border-radius-50" id="main-search-icon-a">
                    <i class="far fa-search" id="main-search-icon"></i>
                    <i class="far fa-arrow-left back-icon disable" id="main-search-icon-back-left"></i>
                </a>
                <span class="tooltiptext tooltiptextTop120 disable" id="main-search-back-left-tooltiptext">
                    Close Search
                </span>
            </figure>
            <i class="extra-option-icon option-icon-search-bar flex align-center justify-center pointer"
                id="option-icon-search-bar" onclick="manageExtraSearchOptions()"></i>
        </div>

        <aside class="extra-search-options extra-search grid absolute disable" id="extra-search-options">
            <dt class="extra-option-dt1 flex align-center">Narrow your search results</dt>

            <div class="grid extra-search-options-div">
                <label class="extra-option-label1">Exact Phrase</label>
                <input type="text" class="extra-option-input1" id="extra-option-input1" onchange="">
                <span class="underline-input-animation"></span>
            </div>
            <div class="grid extra-search-options-div">
                <label class="extra-option-label2">Has words</label>
                <input type="text" class="extra-option-input2" id="extra-option-input2" onchange="">
                <span class="underline-input-animation"></span>
            </div>
            <div class="grid extra-search-options-div">
                <label class="extra-option-label3">Exclude Words</label>
                <input type="text" class="extra-option-input3" id="extra-option-input3" onchange="">
                <span class="underline-input-animation"></span>
            </div>

            <div class="grid relative">
                <label class="extra-option-label4">Date</label>

                <div class="select-div" onclick="manageTimeOptionSelect()">
                    <label id="index-time-label">Anytime</label>
                    <i class="option-icon-select flex align-center justify-center absolute"></i>
                    <aside class="select-options time-select absolute disable" id="index-time-select">
                        <div onclick="selectValue(this)">Anytime</div>
                        <div onclick="selectValue(this)">Today</div>
                        <div onclick="selectValue(this)">Yesterday</div>
                        <div onclick="selectValue(this)">Last week</div>
                    </aside>
                </div>
            </div>

            <footer class="extra-option-button-div flex align-center">
                <button class="extra-option-btn ext-opt-reset pointer" id="extraOptionsClearButton"
                    onclick="resetExtraSearchOptions()">Clear</button>
                <button class="extra-option-btn ext-opt-submit-disable pointer" id="extraOptionsSearchButton"
                    onclick="mainSearch('extra')">Search</button>
            </footer>
        </aside>
        <aside class="search-words absolute disable" id="search-words" onmouseover="suggest.mouseSuggestHoverChange(true)" onmouseout="suggest.mouseSuggestHoverChange(false)">
            <hr class="absolute">
        </aside>
    </div>

    <div class="nav-right-side" id="navigation-bar-right">
        <a href="#" class="login link  <?php if(isset($_SESSION['id'])) echo 'disable'?>" id="login-button" onclick="manageLoginOptions()">Log in</a>

        <div class="outter-container border-radius-50 pointer <?php if(!isset($_SESSION['id'])) echo 'disable'?>" id="outter-container">
            <div>
                <?php 
                    if($_SESSION['profile_choice'] == 0) 
                        echo ('<div class="img small" onclick="manageExtraProfileOptions()"><img src="'.$_SESSION['profile_img'].'" class="imga"></div>');
                    else if($_SESSION['profile_choice'] == 1) 
                        echo ('<div class="img small" onclick="manageExtraProfileOptions()" style="background-color: '.$_SESSION['profile_color'].';">
                                    <div class="letter">
                                        <span>'.$_SESSION['letter'].'</span>
                                    </div>
                                </div>');
                    else if($_SESSION['profile_choice'] == 2) 
                        echo ('<div class="img small" onclick="manageExtraProfileOptions()"><img src="'.$_SESSION['google_profile_img'].'" class="imga"></div>');
                    else if($_SESSION['profile_choice'] == 3) 
                        echo ('<div class="img small" onclick="manageExtraProfileOptions()"><img src="'.$_SESSION['facebook_profile_img'].'" class="imga"></div>');
                    else if($_SESSION['profile_choice'] == 4) 
                        echo ('<div class="img small" onclick="manageExtraProfileOptions()"><img src="'.$_SESSION['github_profile_img'].'" class="imga"></div>');
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
                            if($_SESSION['profile_choice'] == 0) 
                                echo ('<div class="img big" onclick="openLinks(\'account.php\')" ><img src="'.$_SESSION['profile_img'].'" class="imga"></div>');
                            else if($_SESSION['profile_choice'] == 1) 
                                echo ('<div class="img big" onclick="openLinks(\'account.php\')" style="background-color: '.$_SESSION['profile_color'].';">
                                            <div class="letter">
                                                <span>'.$_SESSION['letter'].'</span>
                                            </div>
                                        </div>');
                            else if($_SESSION['profile_choice'] == 2) 
                                echo ('<div class="img big" onclick="openLinks(\'account.php\')"><img src="'.$_SESSION['google_profile_img'].'" class="imga"></div>');
                            else if($_SESSION['profile_choice'] == 3) 
                                echo ('<div class="img big" onclick="openLinks(\'account.php\')"><img src="'.$_SESSION['facebook_profile_img'].'" class="imga"></div>');
                            else if($_SESSION['profile_choice'] == 4) 
                                echo ('<div class="img big" onclick="openLinks(\'account.php\')"><img src="'.$_SESSION['github_profile_img'].'" class="imga"></div>');
                        ?>
                    </div>
                    <div class="camera-container">
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
                <div class="container" onclick="openLinks('account.php')">
                    <span>
                        Manage your account
                    </span>
                </div>
            </div>

        </div>
        <div class="middle-div">
            <div class="container">
               <div class="google" <?php if($_SESSION['googleID'] == 0) echo 'onclick="logOut(\'#login\')"' ?>>
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
            <div class="container">
                <div class="facebook" <?php if($_SESSION['facebookID'] == 0) echo 'onclick="logOut(\'#login\')"' ?>>
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
            <div class="container">
                <div class="github" <?php if($_SESSION['githubID'] == 0) echo 'onclick="logOut(\'#login\')"' ?>>
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
                <div class="button-container" onclick="logOut('')">
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

</nav>