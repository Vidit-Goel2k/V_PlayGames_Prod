<?php
// Import PHPMailer classes into your global namespace
// these must not be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer/Exception.php');
require('PHPMailer/SMTP.php');
require('PHPMailer/PHPMailer.php');

$mail = new PHPMailer(true);

// server settings
// $mail->SMTPDebug = SMTP::DEBUG_SERVER ;                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'vplaygames2k@gmail.com';                 // SMTP username
$mail->Password = '############';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

// Recipients
$mail->setFrom('vplaygames2k@gmail.com', 'V_PlayGames');
$mail->addAddress('viditgoel2k@gmail.com', 'ViditG');     // Add a recipient

// Content
$mail->isHTML(true);
$mail->Subject = 'Test Mail';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
