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
?>
<?php
    $newtab = mysqli_query($conn, "SELECT * FROM newwork");
    $ctvt = mysqli_num_rows($newtab);
    $ctvt += 1;
    /*
    $cft = "UPDATE newwork SET new_no='$ctvt'";
    mysqli_query($conn, $cft);*/
?>
<?php
$upuser = $dom_usr;
$upque = mysqli_query($conn, "SELECT * FROM profilephoto WHERE pp_user = '$upuser'");
$uproww = mysqli_fetch_assoc($upque);
$uppic = $uproww['pp_img'];
?>
<?php
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
        $target = 'Upload/'.$newname;

        $fixdate = new DateTime();
        $strfixdate = $fixdate->format('Y-m-d');
        //$newnousr = $newno_user;
        $sql = "INSERT INTO newwork (new_no, new_hour, new_name, new_user, new_txt, new_img, new_pic) VALUES ('$ctvt','$strfixdate','$new_name','$dom_usr','$new_txt','$newname','$uppic')";
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
        $nwc_for = $nwc_no + 1;
        $nwc_name = $posname;
        $nwc_txt = mysqli_real_escape_string($conn, $_POST['wcm-inpt-text']);
        $sql = "INSERT INTO newcom (nwc_no, nwc_name, nwc_txt, nwc_for) VALUES ('$nwc_no','$nwc_name','$nwc_txt','$nwc_for')";
        // execute query
        mysqli_query($conn, $sql);
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
    <link rel="stylesheet" href="CSS/newside.css">
    <script src="JS/logout.js"></script>
    <script src="JS/comment.js"></script>
    <script src="JS/domain.js"></script>
    <script src="JS/jquery.js"></script>
    <script src="JS/explore.js"></script>
</head>
<body onload="rehei();jnn()">
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
                <li><a href="newworkfeed.php"><img id="log-img3" class="log-img" src="Images/icons/help.png" alt="">Feed</a></li>
                <li><a href="terms.php"><img id="log-img4" class="log-img" src="Images/icons/policy.png" alt="">Terms & Policies</a></li>
                <li><a href="logout.php"><img id="log-img5" class="log-img" src="Images/icons/logout.png" alt="">Log Out</a></li>
            </ul>
        </div>
        <div id="work-section">
        <div id="test">Hi</div>
            <div id="w-inpt">
                <Form method="post" enctype="multipart/form-data" onsubmit="return validatePost()">
                    <!--<input type="text" id="w-inptmess" name="dom_txt" placeholder="Create Post">-->
                    <textarea id="w-inptmess" name="new_txt"  rows="1" placeholder="Create Post" onkeypress="rehei()" onfocus="rehei()"></textarea>
                    <lable id="lw-inptfile" for="w-inptfile">
                        <input type="file" id="w-inptfile" name="pimage">
                        <IMG id="liup" src="Images/new/perm.png">
                    </lable>
                    <input type="submit" id="w-inptsubm" name="uplo" value="post">
                </Form>
                <script>
                    let input = document.getElementById("w-inptfile");
                    let imageName = document.getElementById("liup");
                    input.addEventListener("change", ()=>{
                        let inputImage = document.querySelector("input[type=file]").files[0];
                        imageName.innerText = inputImage.name;
                    })
                </script>
                <script type="text/javascript">
                    function rehei()
                    {
                        textarea = document.querySelector("#w-inptmess");
                        div = document.querySelector("#w-inpt");
                        textarea.addEventListener('input', autoResize, false);
                        function autoResize() {
                            textarea.style.height = 'auto';
                            var tew = textarea.scrollHeight;
                            var tgb = tew - '2';
                            textarea.style.height = tgb + 'px';
                        }
                    }
                </script>
            </div>
        <div id="conities" class="conities">
                <div id="coit-head" class="coit-head">
                    <h2 id="coit-head-h2" class="coit-head-h2">Communities You Can Join</h2>
                </div>
                <?php
                    $coithid = mysqli_query($conn, "SELECT * FROM explore WHERE exp_user = '$dom_usr'");
                    $coitrow = mysqli_fetch_assoc($coithid);
                    $coityes = $coitrow['exp_chk'];
                    echo '<div id="coit-hid" class="coit-hid">'.$coityes.'</div>';
                ?>
                <ul id="coit-menu">
                    <li>
                        <b>1.&#160;&#160;&#160;&#160;&#160;</b>
                        <img id="coit-img1" class="coit-img" src="Images/icons/profile.png" alt="">
                        Sports
                        <div id="coit-join1" class="coit-join">Join</div>
                    </li>
                    <li>
                        <b>2.&#160;&#160;&#160;&#160;</b>
                        <img id="coit-img2" class="coit-img" src="Images/icons/profile.png" alt="">
                        Movies
                        <div id="coit-join2" class="coit-join">Join</div>
                    </li>
                    <li>
                        <b>3.&#160;&#160;&#160;&#160;</b>
                        <img id="coit-img3" class="coit-img" src="Images/icons/profile.png" alt="">
                        Songs
                        <div id="coit-join3" class="coit-join">Join</div>
                    </li>
                    <li>
                        <b>4.&#160;&#160;&#160;&#160;</b>
                        <img id="coit-img4" class="coit-img" src="Images/icons/profile.png" alt="">
                        Computer
                        <div id="coit-join4" class="coit-join">Join</div>
                    </li>
                    <li>
                        <b>5.&#160;&#160;&#160;&#160;</b>
                        <img id="coit-img5" class="coit-img" src="Images/icons/profile.png" alt="">
                        Science
                        <div id="coit-join5" class="coit-join">Join</div>
                    </li>
                    <li>
                        <b>6.&#160;&#160;&#160;&#160;</b>
                        <img id="coit-img6" class="coit-img" src="Images/icons/profile.png" alt="">
                        Tech
                        <div id="coit-join6" class="coit-join">Join</div>
                    </li>
                    <li>
                        <b>7.&#160;&#160;&#160;&#160;</b>
                        <img id="coit-img7" class="coit-img" src="Images/icons/profile.png" alt="">
                        Maths
                        <div id="coit-join7" class="coit-join">Join</div>
                    </li>
                    <li>
                        <b>8.&#160;&#160;&#160;&#160;</b>
                        <img id="coit-img8" class="coit-img" src="Images/icons/profile.png" alt="">
                        Business
                        <div id="coit-join8" class="coit-join">Join</div>
                    </li>
                    <li>
                        <b>9.&#160;&#160;&#160;&#160;</b>
                        <img id="coit-img9" class="coit-img" src="Images/icons/profile.png" alt="">
                        Lifestyle
                        <div id="coit-join9" class="coit-join">Join</div>
                    </li>
                    <li>
                        <b>10.&#160;&#160;&#160;&#160;</b>
                        <img id="coit-img10" class="coit-img" src="Images/icons/profile.png" alt="">
                        Health
                        <div id="coit-join10" class="coit-join">Join</div>
                    </li>
                    <li>
                        <b>11.&#160;&#160;&#160;&#160;</b>
                        <img id="coit-img11" class="coit-img" src="Images/icons/profile.png" alt="">
                        Art
                        <div id="coit-join11" class="coit-join">Join</div>
                    </li>
                    <li>
                        <b>12.&#160;&#160;&#160;&#160;</b>
                        <img id="coit-img12" class="coit-img" src="Images/icons/profile.png" alt="">
                        Finance
                        <div id="coit-join12" class="coit-join">Join</div>
                    </li>
                    <li>
                        <b>13.&#160;&#160;&#160;&#160;</b>
                        <img id="coit-img13" class="coit-img" src="Images/icons/profile.png" alt="">
                        Politics
                        <div id="coit-join13" class="coit-join">Join</div>
                    </li>
                    <li>
                        <b>14.&#160;&#160;&#160;&#160;</b>
                        <img id="coit-img14" class="coit-img" src="Images/icons/profile.png" alt="">
                        Travel
                        <div id="coit-join14" class="coit-join">Join</div>
                    </li>
                    <li>
                        <b>15.&#160;&#160;&#160;&#160;</b>
                        <img id="coit-img15" class="coit-img" src="Images/icons/profile.png" alt="">
                        Coding
                        <div id="coit-join15" class="coit-join">Join</div>
                    </li>
                    <li>
                        <b>16.&#160;&#160;&#160;&#160;</b>
                        <img id="coit-img16" class="coit-img" src="Images/icons/profile.png" alt="">
                        Literature
                        <div id="coit-join16" class="coit-join">Join</div>
                    </li>
                    <li>
                        <b>17.&#160;&#160;&#160;&#160;</b>
                        <img id="coit-img17" class="coit-img" src="Images/icons/profile.png" alt="">
                        Design
                        <div id="coit-join17" class="coit-join">Join</div>
                    </li>
                    <li>
                        <b>18.&#160;&#160;&#160;&#160;</b>
                        <img id="coit-img18" class="coit-img" src="Images/icons/profile.png" alt="">
                        Books
                        <div id="coit-join18" class="coit-join">Join</div>
                    </li>
                </ul>
            </div>
            <div id="conta" class="conta">
                <div id="conta-head" class="conta-head">
                    <h2 id="conta-head-h2" class="conta-head-h2">Contact us</h2>
                </div>
                <ul id="conta-menu">
                    <li>Help</li>
                    <li>Email</li>
                    <li>About</li>
                    <li>Terms</li>
                    <li>Team Members</li>
                    <li>Communities</li>
                    <li>Content Policy</li>
                    <li>Privacy Policy</li>
                </ul>
            </div>
            <div id="work-box">
                <div id="w-left">
                </div>
                <div id="work-post">
                <?php
                    $repro = mysqli_query($conn, "SELECT * FROM newwork");
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
                        $ctt = $row['new_no'];
                        $ct = $ctt - 1;
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