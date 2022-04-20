<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("Location: index.php");
    return;
}

require "config.php";
$uid = $_SESSION["uid"];
$stmt = mysqli_query($conn, "SELECT username,email,password FROM users WHERE id = '$uid'");
$row = mysqli_fetch_assoc($stmt);
$username = $row["username"];
$email = $row["email"];
$password = $row["password"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../resources/profile_style1.css">
    <title>MyPass</title>
</head>

<body>
    <div class="navbar">
        <div class="container flex-nav">
            <div class="navbar-item">
                <a href="index.php">MyPass.com</a>
            </div>
            <div class="navbar-item">
                <a href="password.php">Add Password</a>
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
        <a class="navbar-items" href="password.php">Add Password</a>
        <a class="navbar-items" href="#profile">My Profile</a>
    </div>
-->

    <div class="profile" id="profile">
        <p>My Profile</p>
        <table>
            <tr>
                <td>
                    Username
                </td>
                <td class="info">
                    <?php echo htmlentities($username); ?>
                </td>
            </tr>

            <tr>
                <td>
                    Email ID
                </td>
                <td class="info">
                    <?php echo htmlentities($email); ?>
                </td>
            </tr>

            <tr>
                <td>
                    Password
                </td>
                <td class="info">
                    <?php echo htmlentities($password); ?>
                </td>
            </tr>

        </table>

        <div class="passwords" id="passwords">
            <p>Manage Passwords</p>
            <?php
            echo "<table><tr><th>Sr.No</th><th>Application</th><th>Password</th><th>Options</th></tr>";
            $result = mysqli_query($conn, "SELECT app,pw FROM passwords WHERE uid = '$uid'");
            if (mysqli_num_rows($result) > 0) {
                $id = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><th>" . htmlentities($id) . "</th><th>" . htmlentities($row['app']) . "</th><th>" . htmlentities($row['pw']) . "</th><th><a class='btn-add' href='password.php'>+</a> <a class='btn-del' href='delete.php?id=" . htmlentities($uid) . "&app=" . htmlentities($row['app']) . "&password=" . htmlentities($row['pw']) . "'>x</a></th></tr>";
                    $id++;
                }
            }
            echo "</table>";
            ?>
        </div>
    </div>
</body>

</html>