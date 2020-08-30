<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id"
        content="571327981909-r5sunoo4l6uqducmqm7vjon1af0tmso1.apps.googleusercontent.com">

    <link rel="stylesheet" href="CSS/colors.css">
    <link rel="stylesheet" href="CSS/*.css">
    <link rel="stylesheet" href="CSS/index.css">

    <script src="JS/variables.js" defer></script>
    <script src="JS/show.js" defer></script>
    <script src="JS/main.js" defer></script>
    <script src="JS/sign.js" defer></script>

    <script src="https://kit.fontawesome.com/89923351fd.js" crossorigin="anonymous" defer></script>
    <script src="JS/icon.js" defer></script>

    <title>News Website</title>

</head>

<body>
    
    <main id="main" class="flex align-center justify-center">

        <?php include 'add-ons/side-bar.php' ?>

        <section class="main-content-section full" id="main-content-section">
            <header id="main-content-header" class="header-main-content search">
                    <h1 class="search">Slovenia</h1>
                    <section>
                        <div>
                            <figure class="circle" onclick="saveSearchWord(this)">
                                <i class="fal fa-bookmark"></i>
                            </figure>
                            <figure class="rectangle" onclick="followSearchWord(this)">
                                <i class="fa fa-star"></i> Follow
                            </figure>
                        </div>
                    </section>
                </header>
            <div class="main-content-container">
                
            </div>
            <aside id="main-side-content-container">

            </aside>
        </section>
    </main>

    <?php include 'add-ons/navigation-bar.php' ?>

    <div class="login-option-div grid absolute fixed" id="login-option-div">
        <header class="grid">
            <span class="flex align-center justify-center ">Sign in to</span>
            <h1 class="flex align-center justify-center ">News Website</h1>
        </header>

        <div class="google-facebook-links">
            <div class="external-login-container" id="googleBtn">
                <div class="external-login-botton google-login-button grid pointer">
                    <div class="icons8-google"></div>
                    <label class="flex align-center justify-center pointer">Google</label>
                </div>
            </div>
            <!--! Facebook is curently unavailable-->
            <!-- <div class="external-login-container facebook-login-container relative" onclick="showUnableAtTheMomentNotification()">
                <div class="external-login-botton facebook-login-button grid pointer">
                    <i class="fab fa-facebook fa-2x flex align-center justify-center"></i>                    
                    <label class="flex align-center justify-center pointer">Facebook</label>             
                </div>
            </div> -->
            <div class="external-login-container" id="github-button">
                <div class="external-login-botton github-login-button grid pointer">
                    <i class="fa fa-github fa-2x flex align-center justify-center"></i>
                    <label class="flex align-center justify-center pointer">GitHub</label>
                </div>
            </div>
        </div>
        <hr>
        <span class="or-login absolute">or</span>



        <figure class="x-icon absolute flex align-center justify-center border-radius-50">
            <i class="fal fa-times fa-lg pointer" onclick="manageLoginOptions()"></i>
        </figure>

        <footer class="login-other-options">
            <a href="signin.php" class="blue-link">Create Account</a>
            <a href="login.php" class="blue-link">Log In</a>
        </footer>
    </div>

    <?php include 'add-ons/select-country.php' ?>

    <div class="fixed" id="overlay"></div>

    <?php include 'add-ons/footer-scripts.php' ?>

</body>

<?php include 'add-ons/footer-scripts.php' ?>