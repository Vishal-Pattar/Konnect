<?php 
require 'dbconnect.php';
session_destroy();
session_start();
$qid = session_id();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="CSS/forgot.css">
    <title>Forgot Password</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="JS/forgotreset.js"></script>
</head>
<body>
    <div id="main-div">
        <Img src="Images/logo.png" id="logo">
        <H3 id="logoname"><a id="ka" href="index.php">KONNECT</a></H3>   
        <div id="sub-div">
            <H3 id="resetname">Reset your Password Here</H3>
            <form id="form1" name="form1" action="forgot.php" method="POST" onsubmit="return validatemail()">
                <input type="text" name="mail" class="formele" id="email" placeholder=" Enter your e-mail">
                <div id="mailtag" class="required"></div>
                <input type="submit" name="otpsmbt" class="formele" id="sendotp" value="Send OTP">
            </form>
            <form id="form2" name="form2" action="forgot.php" method="POST" onsubmit="return validatotp()">
                <input type ="text" name="otp" class="formele" id="enterotp" placeholder=" Enter OTP">
                <div id="otptag" class="required"></div>
                <input type="submit" name="resesmbt" class="formele" id="restpass" value="Reset Password">
            </form>
        </div>
    </div>
</body>
</html>
<?php
$conn = connect();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['otpsmbt']))
    {
        $_SESSION['id'] = $qid;
        $useremail = $_POST['mail'];
        $query = mysqli_query($conn, "SELECT * FROM users WHERE user_email = '$useremail'");
        $qmail = mysqli_query($conn, "SELECT * FROM otptable WHERE otp_mail = '$useremail'");
        if($query)
        {
            if(mysqli_num_rows($qmail) == 1) 
            {
                $qbool = 'Y';
                $qsql = "UPDATE otptable SET otp_bool = '$qbool', otp_sessid = '$qid' WHERE otp_mail = '$useremail'";
                $qque = mysqli_query($conn, $qsql);
                if($qque)
                {
                    header("location:send_otp_email.py");
                }
            }
            else if(mysqli_num_rows($query) == 1) 
            {
                $bool = 'Y';
                $sql = "INSERT INTO otptable (otp_mail, otp_bool, otp_sessid)
                VALUES ('$useremail', '$bool', '$qid')";
                $que = mysqli_query($conn, $sql);
                if($que)
                {
                    header("location:send_otp_email.py");
                }
            }
            else
            {
                echo '<script>
                    document.getElementsByClassName("required")[0].innerHTML = "Entered mail id is Invalid.";
                    document.getElementsByClassName("required")[0].style.color = "red";
                </script>';
            }
        }
    }
}
?>
<?php
$conn = connect();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['resesmbt']))
    { 
        $_SESSION['id'] = $qid;
        $userotp = $_POST['otp'];
        $qtop = mysqli_query($conn, "SELECT * FROM otptable WHERE otp_sessid = '$qid'");
        if($qtop)
        {
            if(mysqli_num_rows($qtop) == 1) 
            {
                $rowww = mysqli_fetch_assoc($qtop);
                $qttm = $rowww['otp_val'];
                if($qttm == $userotp)
                {
                    header("location:reset.php");
                }
                else if($qttm != $userotp)
                {
                    echo '<script>
                        document.getElementById("otptag").innerHTML = "Entered OTP is Invalid";
                        </script>';
                }
            }
        }
    }
}
?>
