<?php
require 'dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <Title>Register page</Title>
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="CSS/register.css">
    <script src="JS/register.js"></script>
    <script src="JS/sign.js"></script>
</head>
<body>
    <div id="main-div">
        <Img src="Images/logo.png" id="logo">
        <H3 id="logoname"><a id="ka" href="index.php">KONNECT</a></H3>
        <div id="welop">
            <div id="wel">WELCOME TO KONNECT</div>
        </div>
        <form name="f2" id="form2" method="POST" onsubmit="return validateRegister()">
            <div id="firond" class="formele2">
                <input type="text" name="userfirstname" id="userfirstname" class="formele2" placeholder="First Name">
                <input type="text" name="userlastname" id="userlastname" class="formele2" placeholder="Last Name">
            </div>
            <div id="requsr" class="required"></div>
            <input type="text" name="username" id="username" class="formele2" placeholder="Username">
            <div id="requsr" class="required"></div>
            <input type="password" name="userpass" id="userpass" class="formele2" placeholder="Password">
            <div id="reqpas" class="required"></div>
            <input type="password" name="userpassconfirm" id="userpassconfirm" class="formele2" placeholder="Confirm Password">
            <div id="reqcnf" class="required"></div>
            <input type="email" name="useremail" id="useremail" class="formele2" placeholder="Email">
            <div id="reqeml" class="required"></div>
            <input type="date" name="userdob" id="userdob" class="formele2" placeholder="Date of Birth">
            <div id="reqdob" class="required"></div>
            <!--
            <div id="radgen">
                <input type="radio" name="usergender" id="usergenmale" class="formele2" value="Male">
                <input type="radio" name="usergender" id="usergenfemale" class="formele2" value="Female">
                <input type="radio" name="usergender" id="usergenother" class="formele2" value="Other">
            <label id="rgm" for="usergenmale">Male</label>
            <label id="rgf" for="usergenmale">Female</label>
            <label id="rgo" for="usergenmale">Other</label>
            </div>
            <div id="reqgen" class="required"></div>
            -->
            <br>
            <input type="submit" value="Sign-Up" id="register" name="register">
        </form>
        <script src="JS/sign.js"></script>
        <div id="side-box">
            <div id="s-dh4">
                <h4 id="s-h4">Explore your interest with interesting peoples</h4>
            </div>
            <div id="s-dimg">
                <img id="s-img" src="Images/signup.png" alt="">
            </div>
        </div>
    </div>
</body>
</html>

<?php
$conn = connect();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['register']))
    { 
        $userfirstname = $_POST['userfirstname'];
        $userlastname = $_POST['userlastname'];
        $username = $_POST['username'];
        $userpassword = ($_POST['userpass']);
        $useremail = $_POST['useremail'];
        $userdob = $_POST['userdob'];
        $query = mysqli_query($conn, "SELECT user_username, user_email FROM users WHERE user_username = '$username' OR user_email = '$useremail'");
        if(mysqli_num_rows($query) > 0)
        {
            $row = mysqli_fetch_assoc($query);
            if($username == $row['user_username'])
            {
                echo '<script>
                document.getElementsByClassName("required")[1].innerHTML = "This Username already exists.";
                document.getElementsByClassName("required")[1].style.color = "red";
                </script>';
            }
            if($useremail == $row['user_email'])
            {
                echo '<script>
                document.getElementsByClassName("required")[4].innerHTML = "This Email already exists.";
                document.getElementsByClassName("required")[4].style.color = "red";
                </script>';
            }
            if($username != $row['user_username'] && $useremail != $row['user_email'])
            {
                // Insert Data
                $sql = "INSERT INTO users(user_firstname, user_lastname, user_username, user_password, user_email, user_dob)
                VALUES ('$userfirstname', '$userlastname', '$username', '$userpassword', '$useremail', '$userdob')";
                $query = mysqli_query($conn, $sql);
                if($query)
                {
                    $query = mysqli_query($conn, "SELECT user_id FROM users WHERE user_email = '$useremail' ");
                }
            }
        }
        if(mysqli_num_rows($query) == 0)
        {
            // Insert Data
            $sql = "INSERT INTO users(user_firstname, user_lastname, user_username, user_password, user_email, user_dob)
            VALUES ('$userfirstname', '$userlastname', '$username', '$userpassword', '$useremail', '$userdob')";
            $query = mysqli_query($conn, $sql);
            if($query)
            {
                $query = mysqli_query($conn, "SELECT user_id FROM users WHERE user_email = '$useremail' ");
                header("location:login.php");
            }
        }      
    }
}
?>