<?php
require_once('connection.php'); // Database connection
require 'vendor/autoload.php'; // PHPMailer autoload

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['approve_booking'])) {
    $bookingId = $_POST['booking_id']; // Booking ID from form submission

    // Update booking status
    $updateQuery = "UPDATE booking SET BOOK_STATUS = 'Approved' WHERE BOOK_ID = '$bookingId'";
    if (mysqli_query($con, $updateQuery)) {
        // Fetch user and booking details
        $query = "SELECT u.FNAME, u.LNAME, u.EMAIL, c.CAR_NAME 
                  FROM booking b
                  JOIN users u ON b.EMAIL = u.EMAIL
                  JOIN cars c ON b.CAR_ID = c.CAR_ID
                  WHERE b.BOOK_ID = '$bookingId'";
        $result = mysqli_query($con, $query);
        $data = mysqli_fetch_assoc($result);

        $userName = $data['FNAME'] . ' ' . $data['LNAME'];
        $userEmail = $data['EMAIL'];
        $carName = $data['CAR_NAME'];

        // Initialize PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Use your SMTP host
            $mail->SMTPAuth   = true;
            $mail->Username   = 'your_email@gmail.com'; // Your email
            $mail->Password   = 'your_password'; // Your email password or app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('your_email@gmail.com', 'Car Rental Service');
            $mail->addAddress($userEmail, $userName);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Booking Approval Notification';
            $mail->Body    = "
                <h1>Booking Approved!</h1>
                <p>Hello <strong>$userName</strong>,</p>
                <p>Your booking for the car <strong>$carName</strong> has been approved.</p>
                <p>Thank you for choosing our service!</p>
            ";

            $mail->send();
            echo "Booking approved, and email notification sent!";
        } catch (Exception $e) {
            echo "Booking approved, but email could not be sent. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Failed to approve booking. Please try again.";
    }
}
?>
