<?php
session_start();
include 'connection.php';
include('smtp/PHPMailerAutoload.php'); // Make sure PHPMailer is included

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if email exists
    $query = "SELECT * FROM admin WHERE ADMIN_EMAIL = '$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // Generate a random password
        $new_password = substr(md5(time()), 0, 8); // Generates an 8-character password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $update_query = "UPDATE admin SET ADMIN_PASSWORD = '$hashed_password' WHERE ADMIN_EMAIL = '$email'";
        mysqli_query($con, $update_query);

        // Send email with the new password
        $subject = "Password Reset - Admin Panel";
        $message = "Your new password is: $new_password\nPlease change your password after logging in.";

        smtp_mailer($email, $subject, $message);

        echo "<script>alert('A new password has been sent to your email.'); window.location.href = 'adminlogin.php';</script>";
    } else {
        echo "<script>alert('Email not found. Please try again.'); window.location.href = 'forgot_password.php';</script>";
    }
}

function smtp_mailer($to, $subject, $msg){
    $mail = new PHPMailer(); 
    $mail->IsSMTP(); 
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'tls'; 
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; 
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Username = "mulgechannveer@gmail.com";
    $mail->Password = "qdowinlpaoqjdhvz"; // Use your Gmail App Password
    $mail->SetFrom("mulgechannveer@gmail.com", "Forgot Password Form");
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->AddAddress($to);

    if(!$mail->Send()){
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/forgot.css">
</head>
<body>
    <div class="forgot-password-container">
        <h2>Forgot Password</h2>
        <form action="" method="POST">
            <div class="success-message"></div>
            <div class="error-message"></div>
            <div class="form-group">
                <label for="email">Enter your registered email:</label>
                <input type="email" name="email" id="email" required placeholder="Enter your email address">
            </div>
            <button type="submit">Reset Password</button>
        </form>
        <div class="back-to-login">
            <a href="adminlogin.php">Back to Login</a>
        </div>
    </div>
</body>
</html>
