<?php
// dashboard.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - CodeHub</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p><a href="upload_code.php">Upload Code</a> | <a href="logout.php">Logout</a></p>
</body>
</html>
