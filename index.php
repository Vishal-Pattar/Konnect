<?php
require 'dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <Title>Index page</Title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/main.css">
    <script src="sign.js"></script>
</head>
<body>
    <div id="main-div">
        <Img src="Images/logo.png" id="logo">
        <H3 id="logoname"><a id="ka" href="index.php">KONNECT</a></H3>
        <div id="menu-bar">
            <a href="explore.php"><h3 id="mnbr-exp">Explore</h3></a>
            <h1>|</h1>
            <a href="register.php"><h3>Sign-Up</h3></a>
            <a href="login.php"><h3>Sign-In</h3></a>
        </div>
        <Img src="Images/bgindex1.png" id="bg1">
        <H1 id="bg-slog">Meet the People of your Interest</H1>
    </div>
</body>
</html>