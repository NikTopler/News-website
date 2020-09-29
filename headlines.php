<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="google-signin-client_id" content="571327981909-r5sunoo4l6uqducmqm7vjon1af0tmso1.apps.googleusercontent.com">

    <link rel="stylesheet" href="CSS/colors.css">
    <link rel="stylesheet" href="CSS/*.css">
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/responsive.css">

    <script src="JS/variables.js" defer></script>
    <script src="JS/responsive.js" defer></script>
    <script src="JS/show.js" defer></script>
    <script src="JS/diacritics.js" defer></script>
    <script src="JS/main.js" defer></script>
    <script src="JS/signIn/external.js" defer></script>

    <script src="https://kit.fontawesome.com/89923351fd.js" crossorigin="anonymous" defer></script>
    <script src="JS/icon.js" defer></script>

    <title>News Website</title>

</head>

<body>

    <main id="main" class="flex align-center justify-center">

        <?php include 'add-ons/side-bar.php' ?>

        <section class="main-content-section grid" id="main-content-section">
            <!-- <header id="main-content-header" class="header-main-content search">
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
            </header> -->
            
            <!-- <figure id="main-content-container">
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

            </figure> -->
            <!-- <aside id="main-side-content-container">
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
            </aside> -->
        </section>

    </main>

    <?php include 'add-ons/navigation-bar.php' ?>

    <?php include 'add-ons/login.php' ?>

    <?php include 'add-ons/select-country.php' ?>

    <div class="fixed" id="overlay"></div>

    <?php include 'add-ons/footer-scripts.php' ?>

</body>

</html>