<?php include '../add-ons/head.php' ?>

    <body>

        <main id="main" class="flex align-center justify-center">

            <?php include '../add-ons/side-bar.php' ?>

            <section class="main-content-section grid" id="main-content-section">
                
            <figure></figure>
            
            </section>

        </main>

        <?php include '../add-ons/navigation-bar.php' ?>

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

        <?php include '../add-ons/select-country.php' ?>
        
        <div class="fixed" id="overlay"></div>

        <?php include '../add-ons/footer-scripts.php' ?>
    </body>

</html>