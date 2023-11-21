<?php
require 'partials\_nav.php';

// Innitialising flag variables
$showAlert = false;
$pass_not_match = false;
$exists = false;
$referral_fail = false;
$referral_success=false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    include 'partials\_dbconnect.php';
    
    function updateReferral()
    {
        $check_referral_code_sql = "SELECT * FROM `users` WHERE `users`.`referral_code` = '$_POST[referral_code]' ";
        $result = mysqli_query($GLOBALS['con'], $check_referral_code_sql);
        if ($result) {
            if(mysqli_num_rows($result)==1){
                $result_fetch = mysqli_fetch_assoc($result);
                $referral_points= $result_fetch['referral_points']+50;
                $update_query = "UPDATE `users` SET `referral_points` = '$referral_points' WHERE `sno` = ' $result_fetch[sno] ' ";
                if(!mysqli_query($GLOBALS['con'],$update_query)){
                    $GLOBALS['referral_fail'] ="Referral points could not be given due to some technical error, Please try again.";
                    showAlert($GLOBALS['referral_fail']);
                }
                $GLOBALS['referral_success']=true;
            }
            else{
                $GLOBALS['referral_fail']="The referral code you entered is not valid.";
                showAlert($GLOBALS['referral_fail']);
            }
        } 
        else {
            $GLOBALS['referral_fail']="We are facing some technical issues and your referral code was not validated successfully! We regret the inconvenience caused, Please try again.";
            showAlert($GLOBALS['referral_fail']);
        }
    }

    // fetching credentials from the submitted form
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST["cpass"];

    // Checking if the Username already exists
    $sql = "SELECT * FROM `users` WHERE `uname` LIKE '$uname'";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);
    if ($num != 0) {
        $exists = "Username already exists, please try another username";
        showAlert($exists);
    }

    // Checking if the Email already exists
    $sql = "SELECT * FROM `users` WHERE `email` LIKE '$email'";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);
    if ($num != 0) {
        $exists = "Email already exists, If you are already registered, Please try to login";
        showAlert($exists);
    }

    if ($exists == false) {
        // Checking if the paswords match
        if ($pass == $cpass) {

            if ($_POST['referral_code'] != '' ) {
                updateReferral();
            }
            if(!$referral_fail){

                // Generating referral code for new user
                $referral_code = strtoupper(bin2hex(random_bytes(4)));
    
                // Encrypting the password by Hashing
                $hash = password_hash($pass, PASSWORD_DEFAULT);
    
                // Inserting the user information to our users table in database
                $sql = "INSERT INTO `users` (`uname`, `email`, `pass`, `date`, `referral_code`) VALUES ('$uname', '$email', '$hash', current_timestamp(), '$referral_code')";
                $result = mysqli_query($con, $sql);

                // fetching sno 
                $check_sno_sql = "SELECT * FROM `users` WHERE `users`.`uname` = '$uname' ";
                $result = mysqli_query($con, $check_sno_sql);
                $result_fetch = mysqli_fetch_assoc($result);
                $sno = $result_fetch['sno'];

                // Inserting the user profile img info to our profile_img table in database
                $sql = "INSERT INTO `profile_img` (`user_id`) VALUES ('$sno')";
                $result = mysqli_query($con, $sql);

                // Inserting the game list info to our game_inventory table in database
                $sql = "INSERT INTO `game_inventory` (`user_id`) VALUES ('$sno')";
                $result = mysqli_query($con, $sql);
    
                // Error Handling 
                if ($result) {
                    if($referral_success){
                        $update_query = "UPDATE `users` SET `referral_points` = 100 WHERE `uname` = '$uname' ";
                        mysqli_query($con,$update_query);
                    }
                    $showAlert = true;
                    showAlert($showAlert);
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> We are facing some technical issues and your entry was not submitted successfully! We regret the    inconvenience caused.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }

            }
        } else {
            $pass_not_match = "passwords do not match";
            showAlert($pass_not_match);
        }
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

    <title>Signup</title>

    <link href="rps\style.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <?php


    function showAlert()
    {
        // Error Handling
        if ($GLOBALS['showAlert']) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Lets Go, ' . $GLOBALS['uname'] . ' Your account is now created and you can login!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        // Error Handling
        if ($GLOBALS['referral_fail'] != false) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> ' . $GLOBALS['referral_fail'] . ' 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        // Error Handling
        if ($GLOBALS['exists'] != false) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> ' . $GLOBALS['exists'] . ' 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        // Error Handling
        else if ($GLOBALS['pass_not_match']) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> ' . $GLOBALS['pass_not_match'] . ' 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }

    require 'partials\_form_signup.php';
    require 'partials\_optionalJS.php';

    ?>

</body>

</html>