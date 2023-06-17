
<?php
$to = "test@localhost";
$subject = "Test Email";
$message = "This is a test email.";
$headers = "From: sender@example.com\r\n";;

if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully.";
} else {
    echo "Email sending failed.";
}
?>
