<?php
require '../Controller/email-function.php'; // Adjust the path as needed

$toAddress = 'recipient@example.com';
$toName = 'Recipient Name';
$subject = 'Here is the subject';
$bodyHtml = 'This is the HTML message body <b>in bold!</b>';
$bodyPlain = 'This is the body in plain text for non-HTML mail clients';

$result = sendEmail($toAddress, $toName, $subject, $bodyHtml, $bodyPlain);
echo $result;
?>