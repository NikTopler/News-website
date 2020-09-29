<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="google-signin-client_id" content="571327981909-r5sunoo4l6uqducmqm7vjon1af0tmso1.apps.googleusercontent.com">

    <link rel="stylesheet" href="CSS/colors.css">
    <link rel="stylesheet" href="CSS/*.css">
    <link rel="stylesheet" href="CSS/signin.css">
    <link rel="stylesheet" href="CSS/responsive.css">

    <script src="JS/responsive.js" defer></script>
    <script src="JS/signIn/signin.js" defer></script>

    <script src="https://kit.fontawesome.com/89923351fd.js" crossorigin="anonymous" defer></script>
    <script src="JS/icon.js" defer></script>

    <title>News Website</title>

</head>
<body>
    
    <main>
        <div class="main-container">

            <div class="logo-container">
                <h1>Fews</h1>
            </div>
            <div class="sign-container">
                <h1>Sign In</h1>
            </div>
            <div class="upper-container" id="upper-container">
               <span>Use Fews account to sign in</span>
               <div class="profile disable">
                    <div onclick="switchLoginBox()">
                        <i class="fas fa-user-circle"></i>
                        <span></span>
                        <i class="far fa-chevron-down"></i>
                    </div>
               </div>
            </div> 

            <div class="main-middle-conatiner">
                <div class="email-container">
                    <div class="input-container">
                        <div class="label-container">
                            <label for="email-input">Email</label>
                        </div>
                        <input type="text" name="" id="email-input" autocomplete="off">
                    </div>
                    <div class="error disable">
                        <div class="red"></div>
                        <div class="error-text disable"></div>
                    </div>
                    <div class="forget-container">
                       <a href="">Forgot email?</a>
                    </div>
                    <div class="text">
                        <p>
                            If you don't have an account, you can 
                            <a href="signup.php">create</a> it or sign up with 
                            <a href="#" onclick="urlOpen('#login')">google</a> or 
                            <a href="#" onclick="urlOpen('#login')">facebook</a>. 
                        </p>
                    </div>
                    <div class="button-container">
                        <div class="inner-container">
                            <a href="signup.php">Create account</a>
                        </div>
                        <div class="inner-container">
                            <div class="blue-button" onclick="checkEmail()">Next</div>
                        </div>
                    </div>
                </div>
                <div class="password-container">
                    <div class="input-container">
                        <div class="label-container">
                            <label for="password-input">Enter your password</label>
                        </div>
                        <input type="password" name="password" id="password-input" autocomplete="off">
                        <div class="eye-icon-container" onclick="managePswVisibility()">
                            <div>
                                <i class="far fa-eye fa-lg disable"></i>
                                <i class="far fa-eye-slash fa-lg"></i>
                            </div>
                        </div>
                    </div>
                    <div class="error psw">
                        <div class="red"></div>
                    </div>
                    <div class="button-container">
                        <div class="inner-container">
                            <a href="">Forgot password?</a>
                        </div>
                        <div class="inner-container" onclick="checkPassword()">
                            <div class="blue-button">Next</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

</body>
</html>