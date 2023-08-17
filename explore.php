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
$que = mysqli_query($conn, "SELECT * FROM explore WHERE exp_user ='$usr'");
$roww = mysqli_fetch_assoc($que);
if($que)
{
    if(mysqli_num_rows($que) == 1)
    {
        header("location:newworkfeed.php");
    }
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['expsmbt']))
    {
        $chkbox = $_POST['exphid'];
        if($que)
        {
            if(mysqli_num_rows($que) == 1)
            {
                $ql = "UPDATE explore SET exp_chk = '$chkbox' WHERE exp_user = '$usr'";
                $qus = mysqli_query($conn, $ql);
                if($que)
                {
                    header("location:newworkfeed.php");
                }
            }
            else
            {
                $sql = "INSERT INTO explore (exp_user, exp_chk) VALUES ('$usr', '$chkbox')";
                $qu = mysqli_query($conn, $sql);
                if($qu)
                {
                    header("location:newworkfeed.php");
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="CSS/explore.css">
    <title>Explore</title>
    <script src="JS/explore.js"></script>
</head>
<body>
    <div id="main-div">
        <Img src="Images/logo.png" id="logo">
        <H3 id="logoname"><a id="ka" href="index.php">KONNECT</a></H3>
        <div id="explore">
            <h1>Explore</h1>
        </div>
        <form name="form1" id="form1" action="explore.php" method="POST" onsubmit="return validatexplore()">
            <div id="dombox">
                <div class="box box-1">
                    <input type="checkbox" name="chk1"  id="chk1" class="chk">
                    <h2>Sports</h2>
                    <img src="Images/explore_images/sports.png" alt="sports" id="sports" class="grid-box">
                </div>
                <div class="box box-2">
                    <input type="checkbox" name="chk2"  id="chk2" class="chk">
                    <h2>Movies</h2>
                    <img src="Images/explore_images/movies.png" alt="movies" id="movies" class="grid-box">
                </div>            
                <div class="box box-3">
                    <input type="checkbox" name="chk3"  id="chk3" class="chk">
                    <h2>Songs</h2>
                    <img src="Images/explore_images/songs.png" alt="songs" id="songs" class="grid-box">
                </div>
                <div class="box box-4">
                    <input type="checkbox" name="chk4"  id="chk4" class="chk">
                    <h2>Computer</h2>
                    <img src="Images/explore_images/computer.png" alt="cs" id="cs" class="grid-box">
                </div>            
                <div class="box box-5">
                    <input type="checkbox" name="chk5"  id="chk5" class="chk">
                    <h2>Science</h2>
                    <img src="Images/explore_images/science.png" alt="science" id="science" class="grid-box">
                </div>            
                <div class="box box-6">
                    <input type="checkbox" name="chk6"  id="chk6" class="chk">
                    <h2>Tech</h2>
                    <img src="Images/explore_images/tech.png" alt="tech" id="tech" class="grid-box">
                </div>            
                <div class="box box-7">
                    <input type="checkbox" name="chk7"  id="chk7" class="chk">
                    <h2>Math</h2>
                    <img src="Images/explore_images/math.png" alt="math" id="math"  class="grid-box">
                </div>            
                <div class="box box-8">
                    <input type="checkbox" name="chk8"  id="chk8" class="chk">
                    <h2>Business</h2>
                    <img src="Images/explore_images/business.png" alt="business" id="business" class="grid-box">
                </div>            
                <div class="box box-9">
                    <input type="checkbox" name="chk9"  id="chk9" class="chk">
                    <h2>Lifestyle</h2>
                    <img src="Images/explore_images/lifestyle.png" alt="lifestyle" id="lifestyle" class="grid-box">
                </div>            
                <div class="box box-10">
                    <input type="checkbox" name="chk10"  id="chk10" class="chk">
                    <h2>Health</h2>
                    <img src="Images/explore_images/health.png" alt="health" id="health" class="grid-box">
                </div>            
                <div class="box box-11">
                    <input type="checkbox" name="chk11"  id="chk11" class="chk">
                    <h2>Art</h2>
                    <img src="Images/explore_images/art.png" alt="art" id="art" class="grid-box">
                </div>            
                <div class="box box-12">
                    <input type="checkbox" name="chk12"  id="chk12" class="chk">
                    <h2>Finance</h2>
                    <img src="Images/explore_images/finance.png" alt="finance" id="finance" class="grid-box">
                </div>            
                <div class="box box-13">
                    <input type="checkbox" name="chk13"  id="chk13" class="chk">
                    <h2>Politics</h2>
                    <img src="Images/explore_images/politics.png" alt="politics" id="politics" class="grid-box">
                </div>            
                <div class="box box-14">
                    <input type="checkbox" name="chk14"  id="chk14" class="chk">
                    <h2>Travel</h2>
                    <img src="Images/explore_images/travel.png" alt="travel" id="travel" class="grid-box">
                </div>                          
                <div class="box box-15">
                    <input type="checkbox" name="chk15"  id="chk15" class="chk">
                    <h2>Coding</h2>
                    <img src="Images/explore_images/coding.png" alt="coding" id="coding" class="grid-box">
                </div>                          
                <div class="box box-16">
                    <input type="checkbox" name="chk16"  id="chk16" class="chk">
                    <h2>Literature</h2>
                    <img src="Images/explore_images/literature.png" alt="literature" id="literature" class="grid-box">
                </div>                          
                <div class="box box-17">
                    <input type="checkbox" name="chk17"  id="chk17" class="chk">
                    <h2>Design</h2>
                    <img src="Images/explore_images/design.png" alt="design" id="design" class="grid-box">
                </div>                          
                <div class="box box-18">
                    <input type="checkbox" name="chk18"  id="chk18" class="chk">
                    <h2>Books</h2>
                    <img src="Images/explore_images/books.png" alt="books" id="book" class="grid-box">
                </div>          
            </div>
            <input type="hidden" name="exphid" id="exphid">
            <button type="submit" name="expsmbt" id="expsmbt">Proceed</button>   
        </form>
    </div>
</body>
</html>
<!--
            $chk1 = $_POST['chk1'];
            $chk2 = $_POST['chk2'];
            $chk3 = $_POST['chk3'];
            $chk4 = $_POST['chk4'];
            $chk5 = $_POST['chk5'];
            $chk6 = $_POST['chk6'];
            $chk7 = $_POST['chk7'];
            $chk8 = $_POST['chk8'];
            $chk9 = $_POST['chk9'];
            $chk10 = $_POST['chk10'];
            $chk11 = $_POST['chk11'];
            $chk12 = $_POST['chk12'];
            $chk13 = $_POST['chk13'];
            $chk14 = $_POST['chk14'];
            $chk15 = $_POST['chk15'];
            $chk16 = $_POST['chk16'];
            $chk17 = $_POST['chk17'];
            $chk18 = $_POST['chk18'];
-->