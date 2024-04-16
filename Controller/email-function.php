<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Ensure this path is correct based on your project structure

function sendEmail($toAddress, $toName, $subject, $bodyHtml, $bodyPlain) {
    $mail = new PHPMailer(true); // Passing `true` enables exceptions
    try {
        // Server settings
        $mail->SMTPDebug = 0; // Disable verbose debug output in production
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'mokdadmohamed10@gmail.com'; // SMTP username
        $mail->Password = 'nluieqydzdsdzlqm'; // SMTP password
        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465; // TCP port to connect to

        // Recipients
        $mail->setFrom('mokdadmohamed10@gmail.com', 'Mailer');
        $mail->addAddress($toAddress, $toName); // Add a recipient, Name is optional

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $bodyHtml;
        $mail->AltBody = $bodyPlain;

        $mail->send();
        return 'Message has been sent';
    } catch (Exception $e) {
        return 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
}
?>
