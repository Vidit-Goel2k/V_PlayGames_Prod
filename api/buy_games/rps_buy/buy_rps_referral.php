<?php

require "C:/xampp/htdocs/cwh/partials/_dbconnect.php";
session_start();

if($_SESSION['rps_status']==1){
    header("location: /CWH/game_list.php?alert=Purchased_already");
    die();
}

// fetching sno 
$check_referral_points_sql = "SELECT * FROM `users` WHERE `users`.`uname` = '$_SESSION[uname]' ";
$result = mysqli_query($con, $check_referral_points_sql);
$result_fetch = mysqli_fetch_assoc($result);
$referral_points = $result_fetch['referral_points'];
$_SESSION["referral_points"] = $referral_points;

if($_SESSION['referral_points'] >= 500){
    $new_referral_points =  $_SESSION['referral_points'] - 500;

    // updating referral points in database
    $update_query = "UPDATE `users` SET `referral_points` = $new_referral_points WHERE `sno` = '$_SESSION[sno]' ";
    mysqli_query($con,$update_query);
    
    // updating rps status in database
    $update_query = "UPDATE `game_inventory` SET `rps_status` = 1 WHERE `user_id` = '$_SESSION[sno]' ";
    mysqli_query($con,$update_query);
    header("location: /CWH/game_list.php?alert=Purchase_successful");

}
else{
    header("location: /CWH/game_list.php?alert=Purchase_unsuccessful");
}

?>