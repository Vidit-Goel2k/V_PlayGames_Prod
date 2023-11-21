<?php

// setting alert variables to default
$logged_in = false;
$wrong_pass = false;
$showError = false;
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include 'partials\_dbconnect.php';

// fetching username and password from the submitted form
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

// checking if username exists or not
    $check_uname_sql = "SELECT * FROM `users` WHERE `uname`='$uname' ";
    $result1 = mysqli_query($con, $check_uname_sql);
    $num1 = mysqli_num_rows($result1);

    if ($num1 == 1) {
        while ($row = mysqli_fetch_assoc($result1)) {
            // verifying hashed password
            if (password_verify($pass, $row['pass'])) {

                $logged_in = true;

                session_start();

                // setcookie('cookie1', 'value1', ['samesite' => 'null']);


                $_SESSION["loggedin"] = true;
                $_SESSION["uname"] = $uname;
                
                // fetching sno 
                $check_sno_sql = "SELECT * FROM `users` WHERE `users`.`uname` = '$_SESSION[uname]' ";
                $result = mysqli_query($con, $check_sno_sql);
                $result_fetch = mysqli_fetch_assoc($result);
                $sno = $result_fetch['sno'];
                $_SESSION["sno"] = $sno;

                // fetching score
                $score = $result_fetch['score'];
                $_SESSION['score'] = $score;
                
                // fetching email
                $email = $result_fetch['email'];
                $_SESSION['email'] = $email;

                // fetching referral code
                $referral_code = $result_fetch['referral_code'];
                $_SESSION['referral_code'] = $referral_code;
                
                // fetching referral points
                $referral_points = $result_fetch['referral_points'];
                $_SESSION['referral_points'] = $referral_points;

                // fetching img_id 
                $check_img_id_sql = "SELECT * FROM `profile_img` WHERE `profile_img`.`user_id` = '$_SESSION[sno]' ";
                $result = mysqli_query($con, $check_img_id_sql);
                $result_fetch_img = mysqli_fetch_assoc($result);
                $img_id = $result_fetch_img['id'];
                $_SESSION["img_id"] = $img_id;

                // fetching img_status 
                $img_status = $result_fetch_img['status'];
                $_SESSION["img_status"] = $img_status;

                // fetching rps status 
                $check_rps_status_sql = "SELECT * FROM `game_inventory` WHERE `game_inventory`.`user_id` = '$_SESSION[sno]' ";
                $result = mysqli_query($con, $check_rps_status_sql);
                $result_fetch_rps_status = mysqli_fetch_assoc($result);
                $rps_status = $result_fetch_rps_status['rps_status'];
                $_SESSION["rps_status"] = $rps_status;

                // fetching ttt status
                $ttt_status = $result_fetch_rps_status['ttt_status'];
                $_SESSION["ttt_status"] = $ttt_status;

                header("location: welcome.php?alert=success");
                
            } else {
                $wrong_pass = true;
            }
        }
    } else {
        $showError = "This username is not registered, please signup if you are not registered yet.";
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

    <title>Login</title>

    <link href="rps\style.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <?php

    require 'partials\_nav.php';


    if ($logged_in) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Excellent, ' . $uname . ' You are now logged in!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }
    if ($wrong_pass) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> You have entered a wrong password. Please try again or reset your password by clicking on the forgot password button below.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }
    if ($showError) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> ' . $showError . ' 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }
    if (isset($_GET["newpwd"])) {
        if ($_GET["newpwd"] == "passwordupdated") {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Password reset successful!</strong> Please login with your new password.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    }

    require 'partials\_form_login.php';
    require 'partials\_optionalJS.php';

    ?>

</body>

</html>