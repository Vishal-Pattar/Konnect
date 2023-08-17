<?php
require 'dbconnect.php';
$conn = connect();
session_start();
$qidd = $_SESSION['user_id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$qidd'");
$row = mysqli_fetch_assoc($query);
$user_username = $row['user_username'];
$user_email = $row['user_email'];
date_default_timezone_set('Asia/Kolkata');
$nwdt = date("d-M-Y ; h:i:s A");
if(mysqli_num_rows($query) == 1) 
{
    $row = mysqli_fetch_assoc($query);
    $sql = "UPDATE sessiondetails SET sess_logouttim = '$nwdt' WHERE sess_email = '$user_email' ORDER BY sess_id DESC LIMIT 1";
    $queryy = mysqli_query($conn, $sql);
    session_destroy();
    header("location:login.php");
}
?>
