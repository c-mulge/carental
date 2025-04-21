<?php

require_once('../connection.php');

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password_raw = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password_raw !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    $password = password_hash($password_raw, PASSWORD_BCRYPT);


    //$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure hash

    // Check if email or username already exists
    $check = $con->prepare("SELECT user_id FROM users WHERE email = ? OR username = ?");
    $check->bind_param("ss", $email, $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "Email or Username already exists!";
    } else {
        $stmt = $con->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        if ($stmt->execute()) {
            echo '<script>alert("Registration successful! Please login.")</script>';
            echo '<script>window.location.href = "../index.php";</script>';
        } else {
            echo "Something went wrong. Try again.";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CodeHub</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <section class="register-section">
        <div class="register-container">
            <div class="form-header">
                <a href="index.php" class="logo" style="color: var(--primary-color); justify-content: center;">
                    <i class="fas fa-code"></i> CodeHub
                </a>
                <h1>Create Your Account</h1>
                <p>Start storing and sharing your code snippets</p>
            </div>

            <form action="register.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter your User Name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your Password" required>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm your Password" required>
                </div>
                
                <div class="form-group">
                <input type="submit" name="register" class="btn btn-primary btn-block" value="Create Account">
                </div>
                
                <div class="form-footer">
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </form>
        </div>
    </section>
</body>
</html>

