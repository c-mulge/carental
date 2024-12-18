<?php
session_start();
require_once('connection.php');

if (isset($_POST['register'])) {
    $admin_id = $_POST['admin_id'];
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $confirm_password = $_POST['confirm_password'];
    if (empty($admin_id) || empty($admin_name) || empty($admin_email) || empty($admin_password) || empty($confirm_password)) {
        echo '<script>alert("Please fill in all fields.")</script>';
    } elseif (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Invalid email format.")</script>';
    } elseif ($admin_password !== $confirm_password) {
        echo '<script>alert("Passwords do not match.")</script>';
    } else {
        $query = "SELECT * FROM admin WHERE ADMIN_ID='$admin_id' OR ADMIN_EMAIL='$admin_email'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            echo '<script>alert("Admin ID or Email already exists.")</script>';
        } else {
            $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);
            $insertQuery = "INSERT INTO admin (ADMIN_ID, ADMIN_NAME, ADMIN_EMAIL, ADMIN_PASSWORD) 
                            VALUES ('$admin_id', '$admin_name', '$admin_email', '$hashed_password')";
            if (mysqli_query($con, $insertQuery)) {
                echo '<script>alert("Admin registered successfully!"); window.location.href="adminlogin.php";</script>';
            } else {
                echo '<script>alert("Registration failed. Please try again.")</script>';
            }
        }
    }
}
?>