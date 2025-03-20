<?php
session_start();
require_once('connection.php');

if (isset($_POST['adlog'])) {
    $id = $_POST['adid'];
    $pass = $_POST['adpass'];
    
    if (empty($id) || empty($pass)) {
        echo '<script>alert("Please fill in all fields")</script>';
    } else {
        $query = "SELECT * FROM admin WHERE ADMIN_ID='$id'";
        $res = mysqli_query($con, $query);

        if ($row = mysqli_fetch_assoc($res)) {
            $db_password = $row['ADMIN_PASSWORD'];
            if (password_verify($pass, $db_password)) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $id;
                echo '<script>alert("Welcome ADMINISTRATOR!");</script>';
                header("location: admindash.php");
                exit();
            } else {
                echo '<script>alert("Incorrect password")</script>';
            }
        } else {
            echo '<script>alert("Incorrect User ID")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="adminlogin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="hai">
        <div class="content">
            <h2>Admin Login</h2>
            <form method="POST">
                <input type="text" name="adid" placeholder="Enter User ID" required>
                <input type="password" name="adpass" placeholder="Enter Password" required>
                <div style="display: flex; justify-content: flex-start; width: 100%;">
                    <a href="forgot_password.php" class="forgot-password">Forgot Password?</a>
                </div>
                <input class="btnn" type="submit" value="Login" name="adlog">
            </form>
            <p class="link">Don't have an account?<br>
                <a href="adreg.php">Sign up</a> here
            </p>
        </div>
    </div>
</body>

</html> 
