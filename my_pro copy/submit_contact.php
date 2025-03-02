<?php
// Include PHPMailer
include('smtp/PHPMailerAutoload.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Email subject and body
    $email_subject = "New Contact Form Submission: $subject";
    $email_body = "
        <h2>Contact Form Submission</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Subject:</strong> $subject</p>
        <p><strong>Message:</strong><br>$message</p>
    ";

    // Send the email using the smtp_mailer function
    smtp_mailer("mulgechannveer@gmail.com", $email_subject, $email_body);

    // Redirect back to the contact form with a success message
    echo "<script>alert('Your message has been sent successfully!'); window.location.href = 'co.html';</script>";
}

// SMTP Mailer function
function smtp_mailer($to, $subject, $msg){
    $mail = new PHPMailer(); 
    $mail->IsSMTP(); 
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'tls'; 
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; 
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    // $mail->SMTPDebug = 2; // Enable this to see errors
    $mail->Username = "mulgechannveer@gmail.com";
    $mail->Password = "qdowinlpaoqjdhvz"; // Use your Gmail App Password
    $mail->SetFrom("mulgechannveer@gmail.com", "Contact Form");
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->AddAddress($to);

    // SMTP Options
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    // Send email and handle errors
    if (!$mail->Send()) {
        echo "<script>alert('Oops! Something went wrong: " . $mail->ErrorInfo . "'); window.location.href = 'co.html';</script>";
    }
}
?>
