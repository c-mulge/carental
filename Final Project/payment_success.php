<?php
session_start();
require_once('connection.php');

if (!isset($_GET['payment_id'])) {
    die("Invalid request.");
}

$payment_id = $_GET['payment_id'];
$bid = $_SESSION['bid'] ?? null;
$email = $_SESSION['email'] ?? null;

// Ensure payment ID and booking ID exist
if (!$payment_id || !$bid || !$email) {
    die("Missing details.");
}

// Store payment details in the database
$stmt = $con->prepare("INSERT INTO payment (BOOK_ID, CARD_NO, EXP_DATE, CVV, PRICE) VALUES (?, 'Razorpay', 'N/A', 'N/A', (SELECT PRICE * DURATION FROM booking WHERE BOOK_ID = ?))");
$stmt->bind_param("ii", $bid, $bid);
$stmt->execute();

// Update booking status to "Paid"
$update_stmt = $con->prepare("UPDATE booking SET STATUS = 'Paid' WHERE BOOK_ID = ?");
$update_stmt->bind_param("i", $bid);
$update_stmt->execute();

unset($_SESSION['bid']);

echo "<script>
alert('Payment successful! Your booking is confirmed.');
window.location.href = 'psucess.php';
</script>";
?>
