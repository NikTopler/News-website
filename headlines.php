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

        <!-- <section class="main-content-section grid" id="main-content-section">
            
            <figure id="main-content-container">
                <header id="main-content-header" class="section-main-header header-main-content">
                    <h1>Headlines</h1>
                    <a href="#" class="blue-link flex" onclick="showCategoryNews()">Categories</a>
                </header>
                <article class="coronavirus-article grid article-other" id="coronavirus-article">
                    <a href="#" class="blue-link" id="coronavirus-article-a">
                        COVID-19 information:
                        <span> See the lates coverage of coronavirus</span>
                    </a>
                    <i class="fas fa-chevron-right corona-arrow pointer"></i>
                </article>

            </figure>

            <aside id="main-side-content-container">

                    <article class="weather-article grid relative">
                        <header class="weather-main-header grid">
                            <img src="" alt="" class="flex align-center justify-center">
                            <label class="pointer"></label>
                            <span class="temperature flex"></span>
                        </header>
                        <div class="weather-3-days grid">
                            <section>
                                <header></header>
                                <div class="grid">
                                    <img src="" alt="" class="flex align-center justify-center">
                                    <span class="temperature flex"></span>
                                </div>
                                <div class="grid">
                                    <img src="" alt="" class="flex align-center justify-center">
                                    <span class="flex"></span>
                                </div>
                            </section>
                            <section>
                                <header></header>
                                <div class="grid">
                                    <img src="" alt="" class="flex align-center justify-center">
                                    <span class="temperature flex"></span>
                                </div>
                                <div class="grid">
                                    <img src="" alt="" class="flex align-center justify-center">
                                    <span class="flex"></span>
                                </div>
                            </section>
                            <section>
                                <header></header>
                                <div class="grid">
                                    <img src="" alt="" class="flex align-center justify-center">
                                    <span class="temperature flex"></span>
                                </div>
                                <div class="grid">
                                    <img src="" alt="" class="flex align-center justify-center">
                                    <span class="flex"></span>
                                </div>
                            </section>

                        </div>
                        <footer class="grid">
                            <section class="grid">
                                <div class="pointer active" onclick="changeTemperatureUnit(this)">C</div>
                                <div class="pointer" onclick="changeTemperatureUnit(this)">F</div>
                                <div class="pointer" onclick="changeTemperatureUnit(this)">K</div>
                            </section>
                            <section>
                                <a href="https://www.weatherapi.com/" target="_blank"
                                    class="flex align-center justify-center">WeatherAPI</a>
                            </section>
                        </footer>
                    </article>
                </aside>

        </section> -->

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

</html>