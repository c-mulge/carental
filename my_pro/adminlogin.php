<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style/adlogin.css">
    </head>
    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    </script>
</head>

<body>
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

    <div class="container">
        <h2>Admin Login</h2>
        <form method="POST">
            <input type="text" name="adid" class="input-style" placeholder="Enter User ID" required>
            <input type="password" name="adpass" class="input-style" placeholder="Password" required>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <p>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </p>
            </div>
            <input type="submit" name="adlog" class="btnn" value="LOGIN">
        </form>
            <p class="link">Don't have an account?<br>
                <a href="adreg.php">Sign up</a> here
            </p>
    </div>
</body>

</html> 
