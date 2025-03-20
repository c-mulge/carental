<?php
    session_start();
    require_once('connection.php');
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        if (empty($email) || empty($pass)) {
            echo '<script>alert("Please fill in all fields")</script>';
        } else {
            $query = "SELECT * FROM users WHERE EMAIL='$email'";
            $res = mysqli_query($con, $query);
            if ($row = mysqli_fetch_assoc($res)) {
                $db_password = $row['PASSWORD'];
                if (md5($pass) == $db_password) {
                    $_SESSION['user_logged_in'] = true;
                    $_SESSION['email'] = $email;
                    header("Location: cardetails.php");
                    exit();
                } else {
                    echo '<script>alert("Incorrect password. Please try again.")</script>';
                }
            } else {
                echo '<script>alert("Email not found. Please check and try again.")</script>';
            }
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
</head>

<body>
    

    <div class="hai">
        <div class="content">
            <h2>Login Here</h2>
            <form method="POST">
                <input type="email" name="email" placeholder="Enter Email" required>
                <input type="password" name="pass" placeholder="Enter Password" required>
                <div style="display: flex; justify-content: flex-start; width: 100%;">
                    <a href="forgot_password.php" class="forgot-password">Forgot Password?</a>
                </div>
                <input class="btnn" type="submit" value="Login" name="login">
            </form>
            <p class="link">Don't have an account?<br>
                <a href="register.php">Sign up</a> here
            </p>
        </div>
    </div>
</body>

</html>