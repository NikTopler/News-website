<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="google-signin-client_id" content="571327981909-r5sunoo4l6uqducmqm7vjon1af0tmso1.apps.googleusercontent.com">

    <link rel="stylesheet" href="CSS/colors.css">
    <link rel="stylesheet" href="CSS/*.css">
    <link rel="stylesheet" href="CSS/profileImg.css">
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/responsive.css">

    <link rel="shortcut icon" href="">
    
    <script src="JS/variables.js" defer></script>
    <script src="JS/responsive.js" defer></script>
    <script src="JS/diacritics.js" defer></script>
    <script src="JS/main.js" defer></script>
    <script src="JS/show.js" defer></script>
    <script src="JS/signIn/external.js" defer></script>

    <script src="https://kit.fontawesome.com/89923351fd.js" crossorigin="anonymous" defer></script>
    <script src="JS/icon.js" defer></script>

    <title>News Website</title>

</head>

<body>
    
    <main id="main" class="flex align-center justify-center">

        <?php include 'add-ons/side-bar.php' ?>

        <section class="main-content-section single" id="main-content-section">
            <div class="main-content-container">
                <div class="article-container">

                    <article class="news">
                        
                        <div>
                            <h3>Hello World!</h3>
                            <div>

                            </div>
                            <div class="subtitle">
                                
                            </div>
                        </div>

                    </article>

                </div>
                <aside id="main-side-content-container">
                    <article class="search aside">
                        <header>
                            <div></div>
                            <figure>
                                <img src="" class="border-radius-50 disable">
                            </figure>
                            <span>Topic</span>
                        </header>
                        <section>   
                            <div class="white-button" onclick="saveNews(this)">
                                <i class="far fa-bookmark"></i>
                                <span>Save</span>
                            </div> 
                            <div class="white-button" onclick="follow(this)">
                                <i class="far fa-star fa-lg"></i>
                                <span>Follow</span>
                            </div>
                        </section>
                    </article>
                    <article class="suggested-words aside disable">
                        <header>
                            <h1>Suggested Words</h1>
                            <hr>
                        </header>
                        <section>
                        </section>
                    </article>
                </aside>
            </div>
        </section>
    </main>

    <?php include 'add-ons/navigation-bar.php' ?>

    <?php include 'add-ons/login.php' ?>

    <?php include 'add-ons/select-country.php' ?>

    <div class="fixed" id="overlay"></div>

    <?php include 'add-ons/footer-scripts.php' ?>

    <?php  include 'add-ons/profileImg.php' ?>

</body>
<?php include 'add-ons/footer-scripts.php' ?>


