<!doctype html>
    <html lang="en">

    <head>
        <link href="C:\xampp\htdocs\CWH\rps\style.css" rel="stylesheet" type="text/css" />

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <?php require 'C:\xampp\htdocs\cwh\partials\_nav.php';    ?>
        
        <title>Password Reset</title>
        
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

            label {
                text-align: left;
            }
            </style>

    </head>
    
    <body>
        <!-- Optional JavaScript; choose one of the two! -->
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    </body>
    </html>
    





<?php

// if (!isset($_POST["reset_pwd_submit"])) {
//     header("location:forgot_pass.php");
//     exit;
// }

$selector = $_POST["selector"];
$validator = $_POST["validator"];
$pass = $_POST["pass"];
$cpass = $_POST["cpass"];

if($pass != $cpass){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Passwords do not match. 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        // header("location:forgot_pass.php");
    }
    
    $current_date = date("U");
    
    require 'C:\xampp\htdocs\cwh\partials\_dbconnect.php';   
    //fetching entries using selector  
    $sql = "SELECT * FROM pwd_reset WHERE PwdResetSelector =? AND PwdResetExpires >= ?";
  
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        echo "There was an error";
        exit();
    } 
    else{
        mysqli_stmt_bind_param($stmt, "ss", $selector, $current_date);
        mysqli_stmt_execute($stmt);
        
        $result=mysqli_stmt_get_result($stmt);
        //if no entry found in db
        if(!$row = mysqli_fetch_assoc($result)){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>There was an error!</strong> You need to re-submit your reset request [err_no_1] .
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                exit();
        }
        //if a matching entry is found 
        else{
            $tokenbin = hex2bin($validator);
            
            // verifying token
            $tokencheck = password_verify($tokenbin, $row["PwdResetToken"]);
            
            if($tokencheck === false){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>There was an error!</strong> You need to re-submit your reset request [err_no_2] .
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                exit();
            }

            // if token matches
            elseif($tokencheck == true){
                
                // selecting user using email
                $tokenEmail = $row['PwdResetEmail'];
                $sql = "SELECT * FROM users WHERE email=?;";
                $stmt = mysqli_stmt_init($con);
                
                if (!mysqli_stmt_prepare($stmt,$sql)) {
                    echo "There was an error [err_no_3]";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    // grabbing result in a row
                    $result = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_assoc($result);

                    if(!$row){
                        echo '<div class="alert alert-danger        alert-dismissible fade show" role="alert">
                        <strong>There was an error! [err_no_4]</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        exit();
                    }
                    else{

                        // updating user password in the db 
                        $sql= "UPDATE users SET pass=? WHERE email=?";
                        $stmt = mysqli_stmt_init($con);
                        
                        if (!mysqli_stmt_prepare($stmt,$sql)) {
                            echo "There was an error [err_no_5]";
                            exit();
                        } 
                        else {
                            $newPwdHash = password_hash($pass, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);
                            
                            // deleting the token after the password is reset successfully to avoid any security issues
                            $sql= "DELETE FROM pwd_reset WHERE PwdResetEmail=?";
                            $stmt = mysqli_stmt_init($con);
                            
                            if (!mysqli_stmt_prepare($stmt,$sql)) {
                                echo "There was an error [err_no_6]";
                                exit();
                            } 
                            else{
                                $newPwdHash = password_hash($pass, PASSWORD_DEFAULT);
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                echo "<br>";
                                echo "password successfully changed";
                                header("location: /cwh/login.php?newpwd=passwordupdated");
                            }
                        }
                    }
                }
            }   
        }
    }
    ?>
    