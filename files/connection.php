<?php
ob_start(); 


session_start();

date_default_timezone_set("America/New_York");

try {
    // $con = new PDO("mysql:dbname=MeTube_c6mb;host=mysql1.cs.clemson.edu;", "MeTube_ctg3", "metube123");
    // $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $con = new PDO("mysql:dbname=MeTube;host=localhost;", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>


