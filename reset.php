<?php 
require 'dbconnect.php';
session_start();
if (!isset($_SESSION['id'])) {
    header("location:forgot.php");
}
$qid = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="CSS/reset.css">
    <title>Reset Password</title>
    <script src="JS/forgotreset.js"></script>
</head>
<body>
    <div id="main-div">
        <Img src="Images/logo.png" id="logo">
        <H3 id="logoname"><a id="ka" href="index.php">KONNECT</a></H3>   
        <div id="sub-div">
            <H3 id="pasename">Change your Password Here</H3>
            <form id="form3" name="form3" action="reset.php" method="POST" onsubmit="return validatepass()">
                <input type="password" name="pasn1" class="formele" id="pass" placeholder="Type New Password">
                <div id="passtag" class="required"></div>
                <input type="password" name="pasn2" class="formele" id="repass" placeholder="Retype New Password">
                <div id="cnfpasstag" class="required"></div>
                <input type="submit" name="passsmbt" id="smbtpass" value="Submit">
            </form>
        </div>
    </div>
</body>
</html>
<!--pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"-->
<!--Must contain atleast 1 uppercase, 1 lowercase and 1 numeric characters. Minimum 8 characters-->
<?php
$conn = connect();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['passsmbt']))
    {
        $pass = $_POST['pasn1'];
        $repass = $_POST['pasn2'];
        $qmail = mysqli_query($conn, "SELECT * FROM otptable WHERE otp_sessid = '$qid'");
        $roww = mysqli_fetch_assoc($qmail);
        $usermail = $roww['otp_mail'];
        $sql = "UPDATE users SET user_password = '$pass' WHERE user_email = '$usermail'";
        $que = mysqli_query($conn, $sql);
        if($que)
        {
            header("location:login.php");
        }
    }
}
?>