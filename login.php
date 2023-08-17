<?php 
require 'dbconnect.php';
session_start();
if (isset($_SESSION['user_id'])) {
    header("location:login.php");
}
session_destroy();
session_start();
ob_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
    <link rel="stylesheet" type="text/css" href="CSS/login.css">
    <script src="JS/login.js"></script>
    <script src="JS/sign.js"></script>
</head>
<body>
    <div id="main-div">
        <Img src="Images/logo.png" id="logo">
        <H3 id="logoname"><a id="ka" href="index.php">KONNECT</a></H3>
        <div id="welop">
            <div id="wel">WELCOME BACK</div>
            <div id="op">Login to your account</div>
        </div>
        <form method="POST" name="f1" id="form1" onsubmit="return validateLogin()">
            <input type="text" name="loginusername" id="loginusername" class="formele" placeholder="Enter Username">
            <div id="requser" class="required"></div>
            <br>
            <input type="password" name="loginuserpass" id="loginuserpass" class="formele" placeholder="Enter Password">
            <div id="reqpass"class="required"></div>
            <br>
            <div id="got4">
                <a href="reset.php"><h3>Forgot Password ?</h3></a> 
            </div>
            <input type="submit" id="submt" class="formele" name="Login" value="Log-In">
        </Form>
        <div id="sub-div1">
            <div id="newtag"> 
                <div id="new-here">New Here?</div>
                <div id="tag">Sign up and discover<br> peoples who are waiting <br> to meet you</div>
                <a href="register.php"><button type="button" id="sigin1">Sign-Up</button></a>
            </div> 
        </div>
    </div>
</body>
</html>

<?php
$conn = connect();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['Login'])) // Login process
    { 
        $username = $_POST['loginusername'];
        $userpass = $_POST['loginuserpass'];
        $query = mysqli_query($conn, "SELECT * FROM users WHERE user_username = '$username' AND user_password = '$userpass' ");
        $sqld = mysqli_query($conn, "SELECT user_email FROM users WHERE user_username = '$username'");
        date_default_timezone_set('Asia/Kolkata');
        $nwdt = date("d-M-Y ; h:i:s A");
        if($query)
        {
            if(mysqli_num_rows($query) == 1) 
            {
                $row = mysqli_fetch_assoc($query);
                $_SESSION['user_id'] = $row['user_id'];
                $user_email = $row['user_email'];
                $sql = "INSERT INTO sessiondetails (sess_username, sess_email, sess_logintim)
                VALUES ('$username', '$user_email', '$nwdt')";
                $query = mysqli_query($conn, $sql);
                header("location:explore.php");
            }
            else
            {
                echo '<script>
                    document.getElementsByClassName("required")[0].innerHTML = "Invalid Login Credentials.";
                    document.getElementsByClassName("required")[1].innerHTML = "Invalid Login Credentials.";
                    document.getElementsByClassName("required")[0].style.color = "red";
                    document.getElementsByClassName("required")[1].style.color = "red";
                </script>';
            }
        }
        /*
        if($query)
        {
            if(mysqli_num_rows($query) == 1) 
            {
                $row = mysqli_fetch_assoc($query);
                $_SESSION['user_id'] = $row['user_id'];
                header("location:explore.php");
            }
            else 
            {
                echo '<script>
                    document.getElementsByClassName("required")[0].innerHTML = "Invalid Login Credentials.";
                    document.getElementsByClassName("required")[1].innerHTML = "Invalid Login Credentials.";
                    document.getElementsByClassName("required")[0].style.color = "red";
                    document.getElementsByClassName("required")[1].style.color = "red";
                </script>';
            }
        }*/
    }  
}
?>