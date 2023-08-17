<?php 
require 'dbconnect.php';
session_start();
if(!isset($_SESSION['user_id']))
{
    header("location:login.php");
}
$qid = $_SESSION['user_id'];
?>
<?php
$conn = connect();
$query = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$qid'");
$row = mysqli_fetch_assoc($query);
$usr = $row['user_username'];
$ql = "DELETE FROM explore WHERE exp_user = '$usr'";
$qus = mysqli_query($conn, $ql);
if($qus)
{
    header("location:explore.php");
}
?>