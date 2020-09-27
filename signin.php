<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="google-signin-client_id" content="571327981909-r5sunoo4l6uqducmqm7vjon1af0tmso1.apps.googleusercontent.com">

    <link rel="stylesheet" href="CSS/colors.css">
    <link rel="stylesheet" href="CSS/*.css">
    <link rel="stylesheet" href="CSS/responsive.css">
    <link rel="stylesheet" href="CSS/signup.css">

    <script src="JS/responsive.js" defer></script>

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
            <div class="upper-container">
               <span onclick="test()">Use Fews account to sign in</span>
            </div> 

            <div class="main-middle-conatiner">
                <div class="email-container">
                    <div>
                        <input type="text" name="" id="">
                    </div>
                </div>
                <div class="password-container">
                    <div>
                        <input type="text" name="" id="">
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script>
        function test() {
            let email = document.querySelector('.email-container')
            let password = document.querySelector('.password-container')

            if(!email.classList.contains('active')) {
                email.classList.add('active')
                password.classList.add('active')
            } else {
                email.classList.remove('active')
                password.classList.remove('active')
            }
        }
    </script>
</body>
</html>