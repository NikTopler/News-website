<?php include '../add-ons/head.php' ?>

<body>
    
    <main id="main" class="flex align-center justify-center">
    <section class="main-content-section more library" id="main-content-section">
        <?php include '../add-ons/side-bar.php' ?>
        <div class="main-content-container">
                <div class="article-container">
                    <?php include_once '../include/db.inc.php';

                            class generateUsers extends Dbh {
                                
                                public function generate() {
                                    $sql = "SELECT n.title, n.author, n.subtitle, n.URL_site, n.URL_img, n.date, n.text, n.source_id FROM news n INNER JOIN saved_news sn ON n.id = sn.id INNER JOIN users u ON u.id = sn.user_id WHERE u.email = ?";
                                    $stmt = $this->connect()->prepare($sql);
                                    $stmt->execute([$_SESSION['email']]);
                                    $row = $stmt->fetch();
                                    $n = 0;
                                    while($row = $stmt->fetch()) {
                                       
                                        if($row['URL_img'] == null) {
                                            $img1 = 'no-img';
                                            $img2 = '';
                                        }else {
                                            $img1 = '';
                                            $img2 = '<div class="article-img">
                                            <img src="'.$row['URL_img'].'" alt="">
                                        </div>';
                                        }

                                        echo ('<article class="news a-'.$n.'-a '.$img1.'">
                                        <div class="article-header">
                                            <div class="article-heading-container">
                                                <a href="'.$row['URL_site'].'">
                                                    <h1>'.$row['title'].'</h1>
                                                </a>
                                            </div>
                                            <div class="extra-content-container">
                                                <div class="author">
                                                    <span>'.$this->getSource($row['source_id']).' • '.$row['date'].'</span>
                                                </div>
                                                <div class="extra-options-container">
                                                    <div class="save-container a-'.$n.'-a">
                                                        <div class="save-circle" onclick="saveNews(1,this.parentElement)">
                                                            <i class="fas fa-bookmark yellow-color"></i>
                                                        </div>
                                                        <span class="tooltiptext tooltiptextTop90">Remove Bookmark</span>
                                                    </div>
                                                    <div class="extra-container">
                                                        <div class="extra-circle" onclick="openExtraOptions(this)">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </div>
                                                        <span class="tooltiptext tooltiptextTop120">More</span>
                                                        <aside class="extra-option-container disable a-'.$n.'-a">
                                                            <div class="e-o-c-container" onclick="openNews(this)">
                                                                <div>
                                                                    <i class="fas fa-external-link-alt"></i>
                                                                </div>
                                                                <span>Open</span>
                                                            </div>
                                                            <div class="e-o-c-container" onclick="saveNews(2,this.parentElement)"><div><i class="fas yellow-color fa-bookmark"></i></div><span>Save</span></div>
                                                            <div class="e-o-c-container" onclick="hideArticle(\'a-'.$n.'-a\')"><div><i class="fas fa-minus-circle"></i></div><span>Hide</span></div>
                                                        </aside>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text">
                                            <p>'.$row['subtitle'].'
                                                <span class="disable a-'.$n.'-t">'.$row['text'].'
                                                </span>
                                            </p>
                                        </div>
                                        <div class="footer">
                                            <div onclick="manageArticleText(this,\'a-'.$n.'-t\')">
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                        </div>
                                        '.$img2.'
                                    </article>');
                                        $n++;
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
                            $generateObj = new generateUsers();
                            $generateObj->generate();
                    ?>
                </div>
        </div>
   </section>
        
    </main>

    <?php include '../add-ons/navigation-bar.php' ?>

    <?php  include '../add-ons/login.php' ?>

    <?php include '../add-ons/select-country.php' ?>

    <div class="fixed" id="overlay"></div>

    <?php include '../add-ons/footer-scripts.php' ?>
    <?php  include '../add-ons/profileImg.php' ?>

</body>
