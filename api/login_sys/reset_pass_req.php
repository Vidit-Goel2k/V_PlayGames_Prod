<title>Reset Pass Request</title>

<!-- Creating The Token PHP Script -->
<?php

if (!isset($_POST["reset_req_submit"])) {
    header("location:forgot_pass.php");
    exit;
}

$selector = bin2hex(random_bytes(8));
$token = random_bytes(32);

// echo $selector;
// echo "<br>";
// echo bin2hex($token) ;
// echo "<br>";

$url = "http://localhost/cwh/login_sys/create_new_pwd.php?selector=".$selector."&validator=".bin2hex($token);
// debugging purposes
echo $url;

$expires = date("U") + 3600;

require 'C:\xampp\htdocs\cwh\partials\_dbconnect.php';

$useremail = $_POST["email"];

// fetching uname
$check_uname_sql = "SELECT * FROM `users` WHERE `users`.`email` = '$useremail' ";
$result = mysqli_query($con, $check_uname_sql);
$result_fetch = mysqli_fetch_assoc($result);
$name = $result_fetch['uname'];

// deleting any previous tokens
$sql = "DELETE FROM pwd_reset WHERE PwdResetEmail=?;";
$stmt = mysqli_stmt_init($con);

if (!mysqli_stmt_prepare(
    $stmt,
    $sql
)) {
    echo "There was an error";
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "s", $useremail);
    mysqli_stmt_execute($stmt);
}

// inserting new token into db
$sql = "INSERT INTO pwd_reset (PwdResetEmail, PwdResetSelector, PwdResetToken, PwdResetExpires) VALUES (?,?,?,?);";

$stmt = mysqli_stmt_init($con);

if (!mysqli_stmt_prepare(
    $stmt,
    $sql
)) { 
    echo "There was an error";
    exit();
} else {
    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $useremail, $selector, $hashedToken, $expires);
    mysqli_stmt_execute($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($con);

?>

<!-- Creating The Password Recovery Email -->

<?php

$email = $useremail;

$subject = "Reset Your Password for V_PlayGames";

$message = '<p>We recieved a password reset request. The link to reset your password is below, if you did not make this request, you can ignore this email.</p>';

$message .= '<p>Here is your password reset link: <br>';
$message .= '<a href = "'.$url .'">"'. $url . '</a></p>';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('C:\xampp\htdocs\cwh\Gmail_send\PHPMailer\Exception.php');
require('C:\xampp\htdocs\cwh\Gmail_send\PHPMailer\SMTP.php');
require('C:\xampp\htdocs\cwh\Gmail_send\PHPMailer\PHPMailer.php');

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
$mail->setFrom('vplaygames2k@gmail.com', 'V_PlayGames');
$mail->addAddress($email,$name);     // Add a recipient

// Content
$mail->isHTML(true);
$mail->Subject = $subject;
$mail->Body    = "Name : $name <br> Email : $email <br> Message : $message";

if (!$mail->send()) {
    header("location: forgot_pass.php?reset=failure");
} else {
    header("location: forgot_pass.php?reset=success");
}

?>