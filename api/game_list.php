<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("location:/cwh/login.php");
    exit;
}

require "partials/_dbconnect.php";

// fetching rps status 
$check_rps_status_sql = "SELECT * FROM `game_inventory` WHERE `game_inventory`.`user_id` = '$_SESSION[sno]' ";
$result = mysqli_query($con, $check_rps_status_sql);
$result_fetch_rps_status = mysqli_fetch_assoc($result);
$rps_status = $result_fetch_rps_status['rps_status'];
$_SESSION["rps_status"] = $rps_status;

// fetching ttt status
$ttt_status = $result_fetch_rps_status['ttt_status'];
$_SESSION["ttt_status"] = $ttt_status;

$src_buy_rps = "buy_games/buy_rps_paytm.php";

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Games</title>

    <link href="rps\style.css" rel="stylesheet" type="text/css" />
    
    <style>
        .card{
            background-color: #314a63;
            display: inline-block;
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
            height: 15vw;
            object-fit: cover;
        }

    </style>

</head>

<?php require 'partials\_nav_welcome.php'; ?>

<header>
    <h1>Games</h1>
</header>

<body>    


    <!-- require'partials/_game_list_carousel.php' -->

    <div class="container center">
        <div class="row">
            <div class="col">
                <?php     
                    // rps cards
                    if($rps_status == 1){
                        require('partials/_rps_play_card.php');
                    }
                    else{
                        require('partials/_rps_buy_card.php');
                    }
                ?>
            </div>

            <div class="col">
                <?php
                    // ttt cards
                    if($ttt_status == 1){
                        require('partials/_ttt_play_card.php');
                    }
                    else{
                        require('partials/_ttt_buy_card.php');
                    }
                ?>
            </div>

            <div class="col">
                <?php 
                    require('partials/_more_games_card.php');
                ?>
            </div>

        </div>
    </div>

    <?php require 'partials\_optionalJS.php'; ?>
</body>

</html>