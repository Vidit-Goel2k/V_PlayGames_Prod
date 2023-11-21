<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("location:/cwh/login.php");
    exit;
}
require 'partials\_nav_welcome.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if (isset($_POST['contact_us_submit'])) {

    $name = $_POST['uname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    require('Gmail_send/PHPMailer/Exception.php');
    require('Gmail_send/PHPMailer/SMTP.php');
    require('Gmail_send/PHPMailer/PHPMailer.php');

    $mail = new PHPMailer(true);

    // server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER ;                               // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'vplaygames2k@gmail.com';                 // SMTP username
    $mail->Password = 'vplaygames2k';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    // Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('vplaygames2k@gmail.com', 'V_PlayGames');     // Add a recipient

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = "Name : $name <br> Email : $email <br> Message : $message";

    if (!$mail->send()) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Message could not be sent. Mailer Error:  ' . $mail->ErrorInfo . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    } else {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>success!</strong> Message has been sent successfuly.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Contact Us</title>

    <link href="rps\style.css" rel="stylesheet" type="text/css" />

    <style>
        body {
            background-color: #555555;
            font-family: Asap, sans-serif;
            color: wheat;
            text-align: center;
        }

        div {
            margin: auto;
        }
    </style>

</head>

<body>



    <?php require 'partials\_form_contact_us.php';  ?>

  <!-- Optional JavaScript; choose one of the two! --> 

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

            <!-- Option 2: Separate Popper and Bootstrap JS -->
             <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script> 
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>

</html>