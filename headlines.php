<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="google-signin-client_id" content="571327981909-r5sunoo4l6uqducmqm7vjon1af0tmso1.apps.googleusercontent.com">

    <link rel="stylesheet" href="CSS/colors.css">
    <link rel="stylesheet" href="CSS/*.css">
    <link rel="stylesheet" href="CSS/profileImg.css">
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/responsive.css">
    <link rel="shortcut icon" href="">
    
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


        <section class="main-content-section single headlines" id="main-content-section">
            <div class="main-content-container">
                <div class="article-container">
                    <!-- <article class="news a-1-a">
                        <div class="article-header">
                            <div class="article-heading-container">
                                <a href="">
                                    <h1>Facebook removes Trump post falsely saying flu is more lethal than Covid - CNN</h1>
                                </a>
                            </div>
                            <div class="extra-content-container">
                                <div class="author">
                                    <span>CNN • 12/4/2002</span>
                                </div>
                                <div class="extra-options-container">
                                    <div class="save-container a-1-a">
                                        <div class="save-circle" onclick="saveNews(1,this.parentElement)">
                                            <i class="far fa-bookmark"></i>
                                        </div>
                                        <span class="tooltiptext tooltiptextTop90">Save</span>
                                    </div>
                                    <div class="extra-container">
                                        <div class="extra-circle" onclick="openExtraOptions(this)">
                                            <i class="far fa-ellipsis-v"></i>
                                        </div>
                                        <span class="tooltiptext tooltiptextTop120">More</span>
                                        <aside class="extra-option-container disable a-1-a">
                                            <div class="e-o-c-container" onclick="openNews(this)">
                                                <div>
                                                    <i class="far fa-external-link-alt"></i>
                                                </div>
                                                <span>Open</span>
                                            </div>
                                            <div class="e-o-c-container" onclick="saveNews(2,this.parentElement)"><div><i class="far fa-bookmark"></i></div><span>Save</span></div>
                                            <div class="e-o-c-container" onclick="hideArticle('a-1-a')"><div><i class="far fa-minus-circle"></i></div><span>Hide</span></div>
                                        </aside>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, nulla odit 
                                dolores totam eaque voluptate labore! Neque, eum nihil placeat, 
                                veritatis voluptatum, magnam perferendis beatae ipsa minus iure iste deserunt.
                                <span class="disable a-1-t">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, nulla odit 
                                    dolores totam eaque voluptate labore! Neque, eum nihil placeat, 
                                    veritatis voluptatum, magnam perferendis beatae ipsa minus iure iste deserunt.
                                </span>
                            </p>
                        </div>
                        <div class="footer">
                            <div onclick="manageArticleText(this,'a-1-t')">
                                <i class="far fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="article-img">
                            <img src="https://cdn.cnn.com/cnnnext/dam/assets/201005192147-03-trump-arrives-white-house-1005-removes-mask-super-tease.jpg" alt="">
                        </div>
                    </article>
                    <article class="news a-2-a no-img">
                        
                        <div class="article-header">
                            <div class="article-heading-container">
                                <a href="">
                                    <h1>Facebook removes Trump post falsely saying flu is more lethal than Covid - CNN</h1>
                                </a>
                            </div>
                            <div class="extra-content-container">
                                <div class="author">
                                    <span>CNN • 12/4/2002</span>
                                </div>
                                <div class="extra-options-container">
                                    <div class="save-container a-2-a">
                                        <div class="save-circle" onclick="saveNews(1,this.parentElement)">
                                            <i class="far fa-bookmark"></i>
                                        </div>
                                        <span class="tooltiptext tooltiptextTop90">Save</span>
                                    </div>
                                    <div class="extra-container">
                                        <div class="extra-circle" onclick="openExtraOptions(this)">
                                            <i class="far fa-ellipsis-v"></i>
                                        </div>
                                        <span class="tooltiptext tooltiptextTop120">More</span>
                                        <aside class="extra-option-container disable a-2-a">
                                            <div class="e-o-c-container" onclick="openNews(this)"><div><i class="far fa-external-link-alt"></i></div><span>Open</span></div>
                                            <div class="e-o-c-container" onclick="saveNews(2,this.parentElement)"><div><i class="far fa-bookmark"></i></div><span>Save</span></div>
                                            <div class="e-o-c-container" onclick="hideArticle('a-2-a')"><div><i class="far fa-minus-circle"></i></div><span>Hide</span></div>
                                        </aside>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, nulla odit 
                                dolores totam eaque voluptate labore! Neque, eum nihil placeat, 
                                veritatis voluptatum, magnam perferendis beatae ipsa minus iure iste deserunt.
                                <span class="disable a-2-t">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, nulla odit 
                                    dolores totam eaque voluptate labore! Neque, eum nihil placeat, 
                                    veritatis voluptatum, magnam perferendis beatae ipsa minus iure iste deserunt.
                                </span>
                            </p>
                        </div>
                        <div class="footer">
                            <div onclick="manageArticleText(this,'a-2-t')">
                                <i class="far fa-chevron-down"></i>
                            </div>
                        </div>
                    </article> -->
                </div>
                
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
                    <article class="trending-page">
                        <div class="header">
                            <h1>Trending</h1>
                        </div>
                        <div class="trending-headlines-container">
                            <?php

                                include_once 'include/db.inc.php';

                                class generateTrendingNews extends Dbh {

                                    public function generate() {
                                        $sql = "SELECT n.id, n.author,n.title,n.text,n.source_id,n.URL_site FROM trending t INNER JOIN news n ON n.id = t.news_id LIMIT 20";
                                        $stmt = $this->connect()->prepare($sql);
                                        $stmt->execute();
                                        while($row = $stmt->fetch()) {
                                            echo '<div class="main" onclick="window.open(\''.$row['URL_site'].'\')">';
                                                echo '<div><span>'.substr($row['title'], 0, 100).'...</span></div>';
                                                echo '<div class="small"><span>'.$this->getSource($row['source_id']).'</span></div>';
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
                                $generateObj = new generateTrendingNews();
                                $generateObj->generate();

                            ?>
                        
                        </div>
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

</html>