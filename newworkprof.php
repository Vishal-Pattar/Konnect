<?php 
require 'dbconnect.php';
session_start();
if(!isset($_SESSION['user_id']))
{
    header("location:login.php");
}
?>
<?php
    $conn = connect();
    // If upload button is clicked ...
    $qid = $_SESSION['user_id'];
    $requsr = mysqli_query($conn, "SELECT * FROM users WHERE user_id = $qid");
    $req = mysqli_fetch_array($requsr);
    $posname = $req["user_firstname"] . ' ' . $req["user_lastname"];
    $dom_usr = $req["user_username"];
    if (isset($_POST['uplo'])) 
    {
        // Get User name
        $new_name = $posname;
        // Get image name
        $pimage = $_FILES['pimage']['name'];
        // Get text
        $new_txt = mysqli_real_escape_string($conn, $_POST['new_txt']);
        echo '<br>';
        if($pimage != '')
        {
            $extension = pathinfo($pimage, PATHINFO_EXTENSION);
  
            $randomno = rand(0,100000);
            $rename = 'domain'.date('Y-m-d').$randomno;
    
            $newname = $rename.'.'.$extension;
        
        }
        else
        {
            $newname = '';
        }
        $filename = $_FILES['pimage']['tmp_name'];
            // image file directory
        $target = 'Upload/'.$newname;
  
        $sql = "INSERT INTO newwork (new_name, new_user, new_txt, new_img) VALUES ('$new_name','$dom_usr','$new_txt','$newname')";
        // execute query
        mysqli_query($conn, $sql);
        move_uploaded_file($filename, $target);
    }
    $result = mysqli_query($conn, "SELECT * FROM newwork");
?>  
<?php
    $conn = connect();
    if (isset($_POST['wcm-inpt-smbt'])) 
    {
        $nwc_no = mysqli_real_escape_string($conn, $_POST['wcm-inpt-hidden']);
        $nwc_name = $posname;
        $nwc_txt = mysqli_real_escape_string($conn, $_POST['wcm-inpt-text']);
        $sql = "INSERT INTO newcom (nwc_no, nwc_name, nwc_txt) VALUES ('$nwc_no','$nwc_name','$nwc_txt')";
        // execute query
        mysqli_query($conn, $sql);
    }
?>
<?php
    $conn = connect();
    if (isset($_POST['prof-uplo-smbt'])) 
    {
        $upuser = $dom_usr;
        $upemail = $req["user_email"];
        $upque = mysqli_query($conn, "SELECT * FROM profilephoto WHERE pp_user = '$upuser'");
        $uproww = mysqli_fetch_assoc($upque);
        $uploimg = $_FILES['prof-uplo-file']['name'];
        $upextension = pathinfo($uploimg, PATHINFO_EXTENSION);
        $uprandomno = rand(0,1000);
        $upnewname = $upuser.$uprandomno.'.'.$upextension;
        $uplofile = $_FILES['prof-uplo-file']['tmp_name'];
        $uptar = 'Upload/Profile/'.$upnewname;
        if($upque)
        {
            if(mysqli_num_rows($upque) == 1)
            {
                $upsql = "UPDATE profilephoto SET pp_img = '$upnewname' WHERE pp_user = '$upuser'";
                $udmpsql = "UPDATE newwork SET new_pic = '$upnewname' WHERE new_user = '$upuser'";
            }
            else
            {
                $upsql = "INSERT INTO profilephoto (pp_user, pp_email, pp_img) VALUES ('$upuser','$upemail','$upnewname')";
                $udmpsql = "UPDATE newwork SET new_pic = '$upnewname' WHERE new_user = '$upuser'";
            }
        }
        mysqli_query($conn, $upsql);
        mysqli_query($conn, $udmpsql);
        move_uploaded_file($uplofile, $uptar);
    }
?>
<?php
    $prphque = mysqli_query($conn, "SELECT * FROM profilephoto WHERE pp_user = '$dom_usr'");
    $prphrow = mysqli_fetch_assoc($prphque);
    if($prphque)
    {
        if(mysqli_num_rows($prphque) == 1)
        {
            $actimg = $prphrow['pp_img'];
            $pathactimg ='Upload/Profile/'.$actimg;
        }
        else
        {
            $pathactimg ='Images/prf1.png';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed Page</title>
    <link rel="stylesheet" href="CSS/feedhead.css">
    <link rel="stylesheet" href="CSS/newbody.css">
    <link rel="stylesheet" href="CSS/newprofile.css">
    <script src="JS/logout.js"></script>
    <script src="JS/comment.js"></script>
    <script src="JS/domain.js"></script>
    <script src="JS/jquery.js"></script>
</head>
<body onload="rehei()">
    <div id="main-div">
        <div id="head">
            <div id="logo-name">
                <img id="logo" src="Images/logo-bl.png" alt="">
                <h3 id="lname"><a id="ka" href="index.php">KONNECT</a></h3>
            </div>
            <div id="search-div">
                <img id="search-ic" src="Images/icons/search.png" alt="">
                <input id="search-box" type="search" placeholder=" Search">
            </div>
            <div id="some-box">
                <div id="s-box1" class="s-box">
                    <img id="s-img1" class="s-img" src="Images/icons/plus.png" alt="">
                </div>
                <div id="s-box2" class="s-box">
                    <img id="s-img2" class="s-img" src="Images/icons/email.png" alt="">
                </div>
                <div id="s-box3" class="s-box">
                    <img id="s-img3" class="s-img" src="Images/new/notify.png" alt="">
                </div>
            </div>
                <?php
                echo '<div id="profile" onclick="logout2()">
                    <div id="p-photo">
                        <img id="pf-photo" src="'.$pathactimg.'" alt="">
                    </div>
                    <div id="ph-na">
                        <h4 id="p-h4">'.$posname.'</h4>
                    </div>
                    <img id="p-img1" class="p-img" src="Images/icons/down.png" alt="">
                    </div>';
            ?> 
            </div>
            <ul id="log-menu">
                <li><a href="newworkprof.php"><img id="log-img1" class="log-img" src="Images/icons/profile.png" alt="">Profile</a></li>
                <li><a href="remexplore.php"><img id="log-img2" class="log-img" src="Images/icons/explore.png" alt="">Explore</a></li>
                <li><a href="newworkfeed.php"><img id="log-img3" class="log-img" src="Images/new/home.png" alt="">Feed</a></li>
                <li><a href="terms.php"><img id="log-img4" class="log-img" src="Images/icons/policy.png" alt="">Terms & Policies</a></li>
                <li><a href="logout.php"><img id="log-img5" class="log-img" src="Images/icons/logout.png" alt="">Log Out</a></li>
            </ul>
        </div>
        <div id="work-section">
        <div id="test">Hi</div>
            <div id="prof" class="profile">
                <div id="prof-head" class="prof-head">
                    <div id="prof-head-ins" class="prof-head-ins" onclick="showuploadbutt()">
                        <img id="prof-head-img1" class="prof-img" src="Images/new/camera-plus-outline.png" alt="">
                    </div>
                </div>
                <div id="prof-uplo" class="prof-uplo">
                    <form method="POST" enctype="multipart/form-data" onsubmit="return validateUploimg()">
                        <input type="file" id="prof-uplo-file" class="prof-uplo-inpt" name="prof-uplo-file"><br>
                        <input type="submit" id="prof-uplo-smbt" class="prof-uplo-inpt" name="prof-uplo-smbt" value="Upload">
                    </form>
                </div>
                <div id="prof-sett" class="prof-sett">
                    <img id="prof-sett-img1" class="prof-sett-img" src="Images/new/cog-outline (1).png" alt="">
                </div>
                <div id="prof-ibox" class="prof-ibox">
                <?php   
                    echo '<img id="prof-img1" class="prof-img" src="'.$pathactimg.'" alt="">'
                ?>
                </div>
                <?php 
                    echo "<h2 id='prof-name' class='prof-name'>".$posname."</h2>";
                ?>
                <div id="prof-num" class="prof-num">
                <?php
                $ctpost = mysqli_query($conn, "SELECT * FROM newwork WHERE new_user = '$dom_usr'");
                $ctrow = mysqli_num_rows($ctpost);
                    echo '<div id="prof-num-foll1" class="prof-num-foll">
                            Total Post • '.$ctrow.'
                          </div>';
                ?>
                <?php
                $ctcomm = mysqli_query($conn, "SELECT * FROM newcom WHERE nwc_name = '$posname'");
                $ctcmr = mysqli_num_rows($ctcomm);
                    echo '<div id="prof-num-foll2" class="prof-num-foll">
                            Total Comments • '.$ctcmr.'
                          </div>';
                ?>
                <?php
                /*$prfque = mysqli_query($conn, "SELECT * FROM Sessiondetails WHERE sess_username = '$dom_usr'");*/
                $prfque = mysqli_query($conn, "SELECT sess_logintim FROM sessiondetails WHERE sess_username = '$dom_usr' ORDER BY sess_id DESC LIMIT 1");
                $prfrow = mysqli_fetch_assoc($prfque);
                if($prfque)
                {
                    if(mysqli_num_rows($prfque) == 1)
                    {
                        echo '<div id="prof-num-foll3" class="prof-num-foll">Last Login time<br>'.$prfrow['sess_logintim'].'</div>';
                    }
                }
                ?>
                </div>
            </div>
            <div id="work-box">
                <div id="w-left">
                </div>
                <div id="work-post">
                <?php
                    $ct=0;
                    $repro = mysqli_query($conn, "SELECT * FROM newwork WHERE new_user='$dom_usr'");
                    while($row = mysqli_fetch_array($repro))
                    {
                        $nwdt = $row['new_hour'];
                        $date1 = new DateTime($nwdt);
                        $date2 = new DateTime();
                        $diff = date_diff($date1, $date2);
                        $actdays = $diff->format("%a");
                        $acthours = $diff->format("%h");
                        $actmin = $diff->format("%i");
                        $actsec = $diff->format("%s");
                        $days = number_format($actdays);
                        $hours = number_format($acthours);
                        $minutes = number_format($actmin);
                        if($days != 0)
                        {
                            $stamp = $actdays.' days ago';
                        }
                        else if($days == 0)
                        {
                            $stamp = $acthours.' hrs ago';
                            if($hours == 0)
                            {
                                $stamp = $actmin.' min ago';
                                if($minutes == 0)
                                {
                                    $stamp = $actsec.' sec ago';
                                }
                            }
                        }
                        $dmig = $row['new_img'];
                        echo "<div id='w-one' class='wc-post' name='size'>
                                <div id='w-profile'>";
                        $picimg = $row['new_pic'];
                        if($picimg != '')
                        {
                            echo "<div id='w-img'>
                                    <img id='wpf-img' src='Upload/Profile/".$row['new_pic']."' alt=''>
                                </div>";
                        }
                        if($picimg == '')
                        {
                            echo "<div id='w-img'>
                                    <img id='wpf-img' src='Images/prf1.png' alt=''>
                                </div>";
                        }
                        echo "<p id='w-p3'>".$row['new_name']." • Posted by @".$row['new_user']." • ".$stamp."</p>
                                </div>";
                        echo "<div id='w-fdpot'>
                                <div id='w-ques'>
                                    <p id='w-p'>".$row['new_txt']."</p>
                                </div>";
                        if($dmig != '')
                        {
                            echo "<div id='w-pstimg'>
                                <img id='w-actimg' src='Upload/".$row['new_img']."'>
                                </div>";
                        };
                        echo "</div>";
                        echo "<div id='w-botm' class='w-botm'>
                                <lable id='lcomm' class='lcomm' for='comm'>
                                    <input type='checkbox' class='icomm' id='comm'>
                                    <div id='tcomm' class='tcomm'><img id='com-img1' class='com-img' src='Images/new/comment.png' alt=''>Comments</div>
                                </lable>
                                <div id='cmshar' class='cmbox'>
                                    <img id='com-img2' class='com-img' src='Images/new/share.png' alt=''>
                                    Share
                                </div>
                                <div id='cmsave' class='cmbox'>
                                    <img id='com-img3' class='com-img' src='Images/new/turned.png' alt=''>
                                    Save
                                </div>
                                <div id='cmmore' class='cmbox'>
                                    <img id='com-img4' class='com-img' src='Images/new/more.png' alt=''>
                                </div>
                            </div>
                        </div>";
                        echo "<div id='wcm-one' class='wcm-post'>
                                <form class='wcm-form1' name='wcm-form1' method='POST'>
                                    <input type='hidden' id='wcm-inpt-hidden' class='wcm-inpt-hidden' name='wcm-inpt-hidden'>
                                    <input type='text' id='wcm-inpt-text' class='wcm-inpt-text' name='wcm-inpt-text' placeholder='Add a comment.....'>
                                    <input type='submit' id='wcm-inpt-smbt' class='wcm-inpt-smbt' name='wcm-inpt-smbt' value='Submit' onclick='comnju()'>
                                </form>";
                        echo "<div id='wcm-one-commentbox1' class='wcm-one-commentbox'>";
                        $comn = mysqli_query($conn, "SELECT * FROM newcom WHERE nwc_no = '$ct'");
                        while($comt = mysqli_fetch_array($comn))
                        {
                            echo "<div id='wcm-one-com1' class='wcm-one-com'>
                                    <div id='wcm-one-com1-pfn1' class='wcm-one-com1-pfn'>".$comt['nwc_name']."</div>
                                    <div id='wcm-one-com1-cmt1' class='wcm-one-com1-cmt'>".$comt['nwc_txt']."</div>
                                </div>";
                        }
                           echo "</div>
                            </div>";
                        $ct += 1;
                    }
                    ?>
                    <script>
                        $( ".icomm" ).click(function() {
                        var index = $( ".icomm" ).index( this );
                        $( "#test" ).text( index );
                        const myTimeout = setTimeout(dispcomm(), 1000);
                        });
                    </script>
                </div>
            </div>
        </div>
    </div> 
</body>
</html>