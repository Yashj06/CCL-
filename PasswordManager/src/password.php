<?php
    session_start();
    if(!isset($_SESSION["loggedin"])){
        header("Location: index.php");
        return;
    }

    require "config.php";
    require "password_generator.php";

    if(isset($_POST["submit"])){
        $app = $_POST["app"];
        $length = $_POST["length"] + 0;
        $specialCharacters = $_POST["specialCharacters"] + 0;
        $numbers = $_POST["numbers"] + 0;
        $_SESSION["message"] = "";

        if(strlen($app) < 1 || strlen($app) > 30){
            $_SESSION["message"] = "Invalid App Name. Please Try Again.";
            $_SESSION["message_type"] = "fail";
            header("Location : password.php");
            return;
        }

        $password = generatePassword($length, $specialCharacters, $numbers);
        if(!$password){
            $_SESSION["message"] = "Couldn't Generate Valid Password. Please Try Again.";
            $_SESSION["message_type"] = "fail";
        }
        else{
            $uid = $_SESSION["uid"];
            $stmt = mysqli_query($conn, "INSERT INTO passwords VALUES('$uid', '$app', '$password')");
            $_SESSION["message"] = "Password Generated Successfully";
            $_SESSION["message_type"] = "success";
            
        }
        header("Location: password.php");
        return;
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../resources/password_styles.css">
    <title>MyPass</title>
</head>

<body>
    <div class="navbar">
        <div class="container flex-nav">
            <div class="navbar-item">
                <a href="index.php">MyPass.com</a>
            </div>
            <div class="navbar-item">
                <a href="profile.php">Profile</a>
            </div>
            <div class="navbar-item">
                <a href="logout.php">Log Out</a>
            </div>
        </div>
    </div>

    <!-- 
        
        <div class="navbar">
            <a href="index.php">MyPass.com</a>
            <a class="navbar-items" href="logout.php">Log Out</a>
            <a class="navbar-items" href="profile.php">Profile</a>
        </div>
    -->

    <div class="content">
        <h1>Generate Password</h1>
        <?php $message = isset($_SESSION["message"]) ? $_SESSION["message"] : false;
            if($message !== false){
                if($_SESSION["message_type"] == "fail"){
                    echo "<div class = 'msg msg-error'><p>"
                        .$message.
                    "</p></div>";
                }
                else{
                    echo "<div class = 'msg msg-success'><p>"
                        .$message.
                    "</p></div>";
                }
                unset($_SESSION["message"]);
                unset($_SESSION["message_type"]);
            }
        ?>
        <table>
            <form action="password.php" method="POST">

                <tr>
                    <td>Application Name</td>
                    <td><input type="text" name="app" id="" required></td>
                </tr>

                <tr>
                    <td>Length</td>
                    <td><input type="range" name="length" min="1" max="30" value="15"></td>
                    <td></td>
                </tr>

                <tr>
                    <td>Special Characters</td>
                    <td><input type="range" name="specialCharacters" min="1" max="30" value="15"></td>
                    <td></td>
                </tr>

                <tr>
                    <td>Numbers</td>
                    <td><input type="range" name="numbers" min="1" max="30" value="15"></td>
                    <td></td>
                </tr>

                <tr>
                    <td><input class="btn" name="submit" type="submit" value="Generate"></td>
                    <td><input class="btn" type="reset" value="Reset"></td>
                </tr>
            </form>

        </table>

    </div>


</body>

</html>