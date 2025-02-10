<?php
require_once('connection.php');
include('test.php'); // Include mail function

if (isset($_GET['id']) && isset($_GET['email'])) {
    $book_id = $_GET['id'];
    $email = $_GET['email'];

    // Update the booking status to 'Rejected'
    $query = "UPDATE booking SET BOOK_STATUS='Rejected' WHERE BOOK_ID='$book_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Send rejection email
        $subject = "Booking Rejected - CaRent";
        $message = "<p>Dear User,</p><p>Unfortunately, your booking (ID: $book_id) has been rejected.</p>";
        smtp_mailer($email, $subject, $message);

        echo "<script>alert('Booking Rejected & Email Sent!'); window.location='adminbook.php';</script>";
    } else {
        echo "<script>alert('Error rejecting booking!'); window.location='adminbook.php';</script>";
    }
}
?>
