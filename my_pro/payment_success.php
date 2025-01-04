<!-- not working -->


<?php
require_once('connection.php');
include('user_auth.php');

// Check if Razorpay payment ID is received
if (isset($_GET['payment_id'])) {
    $payment_id = $_GET['payment_id'];
    $user_email = $_SESSION['email'];

    // Update the booking status after successful payment
    $sql = "UPDATE bookings SET PAYMENT_STATUS='Success', PAYMENT_ID='$payment_id' WHERE USER_EMAIL='$user_email' AND PAYMENT_STATUS='Pending'";
    if (mysqli_query($con, $sql)) {
        $message = "Your payment was successful! Your booking is confirmed.";
    } else {
        $message = "There was an error confirming your booking. Please try again.";
    }
} else {
    $message = "Payment failed or canceled.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success - CaRental</title>
    <link rel="stylesheet" href="css/payment_success.css">
</head>
<body>

    <header class="navbar">
        <div class="logo">CaRental</div>
        <nav>
            <a href="cardetails.php">Home</a>
            <a href="aboutus.html">About</a>
            <a href="contactus.html">Contact</a>
        </nav>
    </header>

    <div class="payment-success-container">
        <h1>Payment Status</h1>
        <p class="status-message"><?php echo $message; ?></p>
        <a href="cardetails.php" class="back-button">Back to Dashboard</a>
    </div>

    <footer>
        <p>&copy; 2024 CaRental. All rights reserved.</p>
    </footer>

</body>
</html>
