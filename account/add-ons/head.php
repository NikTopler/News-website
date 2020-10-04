<?php     
    session_start();
    if(!isset($_SESSION['id'])) header('location: ../headlines.php#nopermission')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="google-signin-client_id"
        content="571327981909-r5sunoo4l6uqducmqm7vjon1af0tmso1.apps.googleusercontent.com">

    <link rel="stylesheet" href="../CSS/colors.css">
    <link rel="stylesheet" href="../CSS/*.css">
    <link rel="stylesheet" href="../CSS/account.css">
    <link rel="stylesheet" href="../CSS/profileImg.css">


    <script src="../JS/variables.js" defer></script>
    <script src="../JS/responsive.js" defer></script>
    <script src="../JS/show.js" defer></script>
    <script src="../JS/account.js" defer></script>


    <script src="https://kit.fontawesome.com/89923351fd.js" crossorigin="anonymous" defer></script>
    <script src="../JS/icon.js" defer></script>

    <title>Account</title>

</head>