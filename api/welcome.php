<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("location:/cwh/login.php");
    exit;
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

    <title>Welcome <?php echo $_SESSION["uname"] ?></title>

    <link href="rps\style.css" rel="stylesheet" type="text/css" />
    
    <style>
        .card{
            background-color: #314a63;
        }

        .center {
            margin: 0 auto;
            width: 100%;
        }

        .mt{
            margin-top: 20px;
        }

        .card-img-top {
            width: 100%;
            height: 20vw;
            object-fit: cover;
        }

    </style>

</head>

<?php require 'partials\_nav_welcome.php'; ?>

<header>
    <h1> Welcome <?php echo $_SESSION["uname"]; echo'' ; ?> </h1>
</header>

<?php
    if (isset($_GET["alert"])) {
        if ($_GET["alert"] == "success") {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Excellent, ' . $_SESSION["uname"] . ' You are now logged in!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
?>

<body>

    <?php
        // checking if the user has uploaded an image or not.
        if($_SESSION['img_status'] == 0 ){
            $img_src= "uploads/default.jpg";
        }
        else{
            $img_src= 'uploads/profile'.$_SESSION['sno'].'.jpg';
            // .$_SESSION['fileActualExt'].'?'.mt_rand().'>';
        }
    ?>
        
    <div class="card center mt" style="width: 18rem;">
        <img src= "<?php echo $img_src; ?>" class="card-img-top center" alt="Profile Image">
        
        <div class="card-body">
            <h2 class="card-title" style="text-align: center;"><?php echo $_SESSION["uname"] ?></h2>
            <p class="card-text" style="text-align: center;">
                <?php echo 'Email id : '. $_SESSION["email"] ?>
                <br>
                <?php echo 'score : '. $_SESSION["score"] ?>
                <br>
                <?php echo 'referral code : '. $_SESSION["referral_code"] ?>
                <br>
                <?php echo 'referral points : '. $_SESSION["referral_points"] ?>
            </p>
            <a href="profile_img\profile.php" class="btn btn-primary center">Change Profile Image</a>
        </div>
    </div>

    <?php require 'partials\_optionalJS.php'; ?>
</body>

</html>