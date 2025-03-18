<?php
require_once('connection.php');
include('test.php'); // Include mail function

if (isset($_GET['id']) && isset($_GET['email'])) {
    $book_id = $_GET['id'];
    $email = $_GET['email'];

    // Fetch booking details
    $query = "SELECT * FROM booking WHERE BOOK_ID='$book_id'";
    $result = mysqli_query($con, $query);
    $booking = mysqli_fetch_assoc($result);

    if ($booking) {
        // Update the booking status to 'Approved'
        $updateQuery = "UPDATE booking SET BOOK_STATUS='Approved' WHERE BOOK_ID='$book_id'";
        $updateResult = mysqli_query($con, $updateQuery);

        if ($updateResult) {
            // Email content with booking details
            $subject = "Booking Approved - CaRent";
            $message = "
                <p>Dear User,</p>
                <p>We are happy to inform you that your booking has been approved. Here are the details:</p>
                <table border='1' cellpadding='5' cellspacing='0'>
                    <tr><td><strong>Booking ID:</strong></td><td>{$booking['BOOK_ID']}</td></tr>
                    <tr><td><strong>Car ID:</strong></td><td>{$booking['CAR_ID']}</td></tr>
                    <tr><td><strong>Booking Place:</strong></td><td>{$booking['BOOK_PLACE']}</td></tr>
                    <tr><td><strong>Booking Date:</strong></td><td>{$booking['BOOK_DATE']}</td></tr>
                    <tr><td><strong>Duration:</strong></td><td>{$booking['DURATION']} days</td></tr>
                    <tr><td><strong>Destination:</strong></td><td>{$booking['DESTINATION']}</td></tr>
                    <tr><td><strong>Return Date:</strong></td><td>{$booking['RETURN_DATE']}</td></tr>
                    <tr><td><strong>Phone Number:</strong></td><td>{$booking['PHONE_NUMBER']}</td></tr>
                    <tr><td><strong>Status:</strong></td><td>Approved</td></tr>
                </table>
                <p>Thank you for choosing CaRent. Enjoy your ride!</p>
                <p>Best regards,<br>CaRent Team</p>
            ";

            smtp_mailer($email, $subject, $message);

            echo "<script>alert('Booking Approved & Email Sent!'); window.location='adminbook.php';</script>";
        } else {
            echo "<script>alert('Error updating booking status!'); window.location='adminbook.php';</script>";
        }
    } else {
        echo "<script>alert('Booking not found!'); window.location='adminbook.php';</script>";
    }
}
?>
