<?php include '../add-ons/head.php' ?>

<body>
    
    <main id="main" class="flex align-center justify-center">

        <?php include '../add-ons/side-bar.php' ?>

        <section class="main-content-section full" id="main-content-section">
                <div class="main-content-container">
                    <div class="article-container">
                        <div class="main-header">
                                <div class="title-container">
                                    <div class="image-container border-radius-50 health">
                                        <i class="far fa-heart-rate fa-lg"></i>
                                    </div>
                                <div class="title">
                                        <h2>Health</h2>
                                </div>
                                </div>
                                <div class="buttons">
                                    <div class="white-button follow topic" onclick="follow(this)">
                                        <i class="far fa-star fa-lg"></i>
                                        <span>Follow</span>
                                    </div>
                                    <div class="white-button share topic">
                                            <i class="fas fa-share-alt fa-lg"></i>
                                        <span>Share</span>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </section>

    </main>

    <?php include '../add-ons/navigation-bar.php' ?>

    <?php include '../add-ons/login.php' ?> 

    <?php include '../add-ons/select-country.php' ?>

    <div class="fixed" id="overlay"></div>
    <?php  include '../add-ons/profileImg.php' ?>

    <?php include '../add-ons/footer-scripts.php' ?>

</body>

<?php include '../add-ons/footer-scripts.php' ?>