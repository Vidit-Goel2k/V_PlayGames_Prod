<?php 
    // checking if the user has entered the page through the submit button
    if (!isset($_POST["p_img_submit"])) {
        header("location:profile.php");
        exit;
    }
    session_start();
    require 'C:\xampp\htdocs\CWH\partials\_dbconnect.php';
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <title>File Upload</title>
    
    <link href="rps\style.css" rel="stylesheet" type="text/css" />
    
</head>

<body>
    
    <?php
    require 'C:\xampp\htdocs\CWH\partials\_nav_welcome.php';
    
    // setting alert variables to default
    $showError = false;
    
    // fetching variables about the upload file
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    
    // separating the file extension from the name of the file
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $_SESSION['fileActualExt'] = $fileActualExt;
    
    // specifying what file types are allowed to upload
    $allowed = array('jpg');
    
    // checking if the file type is correct
    if(in_array($fileActualExt, $allowed)){
        // checking if there was any error uploading the file
        if($fileError === 0){
            // checking if the file size is larger than 1 mb
            if($fileSize<= 1000000){

                // giving unique file name so there is no redundancy
                $fileNewName = "profile".$_SESSION['sno'].".".$fileActualExt;

                // specifying where to upload the file
                $fileDestination = 'C:/xampp/htdocs/CWH/uploads/'.$fileNewName;

                // function to move the file from the temp location to the desired location
                move_uploaded_file($fileTmpName, $fileDestination);

                // updating profile image status in database
                $sql = "UPDATE profile_img SET status=1 WHERE user_id = $_SESSION[sno]";
                $result = mysqli_query($con, $sql);

                // fetching img_status in session var
                $_SESSION["img_status"] = 1;

                // returning to profile img page after a successful uploading
                header("location: profile.php?alert=success");
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> The file is too big please upload a smaller file. 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> There was an error while uploading the file please try again. 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }
    else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> This file type is not supported, Please enter a jpg file. 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }


    require 'C:\xampp\htdocs\CWH\partials\_optionalJS.php';
    ?>

</body>

</html>