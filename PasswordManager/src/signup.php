<?php
session_start();
require "config.php";

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $_SESSION["message"] = "";

    $stmt = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($stmt) > 0) {
        $_SESSION["message"] = "Username already exists.";
    } else {
        $stmt = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        if (mysqli_num_rows($stmt) > 0) {
            $_SESSION["message"] = "Email id already exists.";
        } else {
            $stmt = mysqli_query($conn, "INSERT INTO users(username, email, password) VALUES('$username', '$email', '$password')");
            $stmt_id = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username'");
            $row = mysqli_fetch_assoc($stmt_id);
            if ($stmt) {
                if ($stmt_id) {
                    $_SESSION["uid"] = $row["id"];
                    $_SESSION["loggedin"] = true;
                    unset($_SESSION["message"]);
                    header("Location: profile.php");
                    return;
                }
            }
        }
    }
    header("Location: signup.php");
    return;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../resources/signup_style.css">
    <title>MyPass</title>
</head>

<body>
    <div class="navbar">
        <div class="container flex-nav">
            <div class="navbar-item">
                <a href="index.php">MyPass.com</a>
            </div>
            <div class="navbar-item">
                <a href="#about">About Us</a>
            </div>
            <div class="navbar-item">
                <a href="#features">Features</a>
            </div>
        </div>
    </div>

    <div class="content">
        <h2 class="text-center">Sign Up</h2>
        <?php $message = isset($_SESSION["message"]) ? $_SESSION["message"] : false;
        if ($message !== false) {
            echo "<div class = 'msg-error'><p>"
                . $message .
                "</p></div>";
            unset($_SESSION["message"]);
        }
        ?>
        <form method="POST">
            <table>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" id="username" required></td>
                </tr>
                <tr>
                    <td>Email ID</td>
                    <td><input type="email" name="email" id="email" required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" id="password" required></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="confirmpassword" id="confirmpassword" required></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Sign Up" onclick="return validateUser()"></td>
                    <td><input type="reset" value="Reset"></td>
                </tr>
            </table>
        </form>
    </div>

    <script src="signup.js"></script>
</body>

</html>