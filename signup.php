<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="google-signin-client_id" content="571327981909-r5sunoo4l6uqducmqm7vjon1af0tmso1.apps.googleusercontent.com">

    <link rel="stylesheet" href="CSS/colors.css">
    <link rel="stylesheet" href="CSS/*.css">
    <link rel="stylesheet" href="CSS/signup.css">
    <link rel="stylesheet" href="CSS/responsive.css">

    <script src="JS/responsive.js" defer></script>
    <script src="JS/signIn/signup.js" defer></script>

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
                <h1>Create your Fews Account</h1>
            </div>
            <div class="main-middle-conatiner">
              
                <div class="double">
                    <div class="name-container">
                        <div class="input-container">
                            <div class="label-container">
                                <label for="name-input">First Name</label>
                            </div>
                            <input type="text" name="name" id="name-input" autocomplete="off">
                        </div>
                        <div class="error disable">
                            <div class="red"></div>
                        </div>
                    </div>
                    <div class="surname-container">
                        <div class="input-container">
                            <div class="label-container">
                                <label for="surname-input">Last Name</label>
                            </div>
                            <input type="text" name="surname" id="surname-input" autocomplete="off">
                        </div>
                        <div class="error disable">
                            <div class="red"></div>
                        </div>
                    </div>
                </div>
                <div class="error name disable">
                    <div class="red"></div>
                </div>
                <div class="email-container">
                    <div class="input-container">
                        <div class="label-container">
                            <label for="email-input">Email</label>
                        </div>
                        <input type="text" name="email" id="email-input" autocomplete="off">
                    </div>
                </div>
                <div class="error email disable">
                    <div class="red"></div>
                </div>
                <div class="double psw">
                    <div class="psw-container">
                        <div class="input-container">
                            <div class="label-container">
                                <label for="psw-input">Password</label>
                            </div>
                            <input type="password" name="password" id="psw-input" autocomplete="off">
                        </div>
                    </div>
                    <div class="psw-repeat-container">
                        <div class="input-container">
                            <div class="label-container">
                                <label for="psw-repeat-input">Repeat</label>
                            </div>
                            <input type="password" name="password-repeat" id="psw-repeat-input" autocomplete="off">
                        </div>
                    </div>
                    <div class="eye-icon-container" onclick="managePasswordVisibility(this)">
                        <div>
                            <i class="far fa-eye fa-lg disable"></i>
                            <i class="far fa-eye-slash fa-lg"></i>
                        </div>
                    </div>
                </div>
                <div class="error psw disable">
                    <div class="red"></div>
                </div>
                <div class="select-div" onclick="manageOptionSelect()">
                    <label id="index-country-label">Select Country</label>
                    <div> <i class="option-icon-select flex align-center justify-center"></i> </div>
                    <aside class="select-options country-select absolute disable" id="index-country-select">
                    </aside>
                </div>
                <div class="error country disable">
                    <div class="red"></div>
                </div>
                <div class="error result disable">
                    <div class="red"></div>
                </div>
                <div class="text">
                    <p>
                        You can also sign up with  
                        <a href="#" onclick="urlOpen('#login')">google</a> or
                        <a href="#" onclick="urlOpen('#login')">facebook</a>.
                    </p>
                </div>
                <div class="button-container">
                        <div class="inner-container">
                            <a href="signin.php">Sign in instead</a>
                        </div>
                        <div class="inner-container">
                            <div class="blue-button" onclick="register()">Next</div>
                        </div>
                    </div>
                </div>
        </div>
    </main>

</body>
</html>