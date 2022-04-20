<?php
    session_start();
    require "config.php";

    $id = $_GET["id"];
    $app = $_GET["app"];
    $password = $_GET["password"];

    $stmt = mysqli_query($conn, "DELETE FROM passwords WHERE uid = '$id' AND app = '$app' AND pw = '$password'");
    if($stmt){
        header("Location: profile.php");
        return;
    }
    else{
        echo "Couldn't delete password";
    }
?>
