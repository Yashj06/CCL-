<?php
    $server = "localhost";
    $uname = "root";
    $pass = "";
    $db = "mypass";

    $conn = mysqli_connect($server, $uname, $pass, $db);
    if(!$conn){
        die("Database Connectivity Error ! Please Try Again.");
        return;
    }
?>
