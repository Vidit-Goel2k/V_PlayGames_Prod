<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("location:/cwh/login.php");
    exit;
}

require 'C:\xampp\htdocs\CWH\partials\_nav_welcome.php';
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
    
    <title>Profile Image</title>

    <link href="style.css" rel="stylesheet" type="text/css" />
    
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
    
    
    <header>
        <h1> Welcome <?php echo $_SESSION["uname"] ?> </h1>
    </header>
    <?php
        if (isset($_GET["alert"])) {
            if ($_GET["alert"] == "success") {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> Profile Image set successfully.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }
    ?>
    <h5>Upload your profile picture</h5>

    <div class="container mt-3 p-4" class="row">
        <form class="form-inline" action="upload.php" method="post" enctype="multipart/form-data">
            <div class=" mb-3 col-5">
                <input placeholder="Profile image"  type="file" maxlength="52" class="form-control" id="file" name="file" aria-describedby="emailHelp" required>
                <label for="file" class="form-label "> Please upload only jpg file less than 1 mb in size</label>
            </div>
            <button type="submit" name="p_img_submit" class="btn btn-primary">Upload Profile image</button>
        </form>
    </div>
    
    

    <?php require 'C:\xampp\htdocs\CWH\partials\_optionalJS.php'; ?>
</body>

</html>