<?php
    session_start();
    require "config.php";

    if(isset($_POST["submit"]))
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $_SESSION["message"] = "";

        $stmt = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password= '$password'");
        if(mysqli_num_rows($stmt) == 0){
            $_SESSION["message"] = "Invalid Credentials!";
        }    
        else{
            $stmt_id = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username'");
            $row = mysqli_fetch_assoc($stmt_id);
            if($stmt_id){    
                $_SESSION["uid"] = $row["id"];
                $_SESSION["loggedin"] = true;
                unset($_SESSION["message"]);
                header("Location: profile.php");
                return;
            }
        }
        header("Location: index.php");
        return;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../resources/index_style.css">
    <title>MyPass</title>
</head>

<body onresize="setWidth()" onload="setWidth()">
    <div class="navbar">
        <div class="container flex-nav">
            <div class="navbar-item">
                <a href="">MyPass.com</a>
            </div>
            <div class="navbar-item">
                <a href="#features">Features</a>
            </div>
            <div class="navbar-item">
                <?php if(isset($_SESSION["loggedin"])){echo '<a href="profile.php">Profile</a>';}else{echo '<a href="signup.php">Sign Up</a>';}?>
            </div>
        </div>
    </div>

    <div class="navbar">
        <div class="container flex-body">
            <div class="body">
                <h1 class="text-center">MyPass - Password Vault</h1>
                <p class="info text-center">MyPass - Your One-stop Solution To All Your Privacy Problems.</p>
                <p class="info text-center">Generate Strong Passwords Using Our Custom Password Generator.</p>
            </div>
            <div class="login-form">
                <h3>Log In</h3>
                <?php $message = isset($_SESSION["message"]) ? $_SESSION["message"] : false;
                if($message !== false){
                echo "<p class='text-danger'>"
                        .$message.
                    "</p>";
                unset($_SESSION["message"]);
                }
                ?>
                <form method="POST">
                    <label for="username">Username</label><br>
                    <input type="text" name="username" id="username" placeholder="Username" required><br>
                    <label for="password">Password</label><br>
                    <input type="password" name="password" id="password" placeholder="Password" required><br><br>
                    <input type="submit" value="Login" name="submit">
                </form>
            </div>
        </div>
    </div>

    <div class="container features" id="about">
        <h2 class="about-header text-center">About Us</h2>
        <p class="text-center">Established in 2019, MyPass.com aims to secure your online lifestyle using our industry-standard features.</p>
        <p class="text-center">Privacy is of utmost important in today's era.</p>
        <p class="text-center">MyPass.com aims to provide a Kick-Ass solution to this problem.</p>
    </div>

    <div class="container" id="features">
        <h2 class="features-header text-center">Our Features</h2>
        <div class="features grid" id="feature">
            <div class="features-info">
                <img src="../resources/icon1.png" alt="Secured Storage">
                <p class="text-center" id="info-1"></p>
            </div>
            <div class="features-info">
                <img src="../resources/icon2.png" alt="Strong Passwords">
                <p class="text-center" id="info-2"></p>
            </div>
            <div class="features-info">
                <img src="../resources/icon3.png" alt="Free For All">
                <p class="text-center" id="info-3"></p>
            </div>
        </div>
    </div>

    
    <div class="footer-info">
        <p class="text-center">&#169; MyPass.com. All Rights Reserved. Created As Part Of Our WDL Project.</p>
    </div>
    
    <script src="script.js"></script>

</body>

</html>