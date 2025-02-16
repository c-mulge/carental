<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Login</title>
    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    </script>
    <link rel="stylesheet" href="style/login.css">
</head>

<body>
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

    <div class="hai">
        <div class="content">
            <h2>Login Here</h2>
            <form method="POST">
                <input type="email" name="email" placeholder="Enter Email" required>
                <input type="password" name="pass" placeholder="Enter Password" required>
                <div style="display: flex; justify-content: space-between; align-items: center;">
            <p>
                <a href="forgot_password.php" class="forgot-password">Forgot Password?</a>
            </p>

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
