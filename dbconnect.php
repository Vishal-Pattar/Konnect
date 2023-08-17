<?php
// Establish Connection to Database
function connect() {
    static $conn;
    if ($conn === NULL)
    { 
        $conn = mysqli_connect('database-auth.000webhostapp.com','id19720416_admin','Kwbs#22tm','id19720416_konnect');
    }
    return $conn;
}
date_default_timezone_set('Asia/Kolkata');
?>
// $conn = mysqli_connect('sql11.freemysqlhosting.net','sql11528057','5bhKPxpkJk','sql11528057');