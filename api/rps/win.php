<?php

include 'C:\xampp\htdocs\cwh\partials\_dbconnect.php';
require 'C:\xampp\htdocs\cwh\partials\_nav_rps.php';

session_start();

// updating score
$_SESSION['score'] = $_SESSION['score'] + 100;
$update_score_sql = "UPDATE `users` SET `score` = '$_SESSION[score]' WHERE `users`.`sno` = '$_SESSION[sno]' ";
$result = mysqli_query($con, $update_score_sql);

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Win</title>
  <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<header>
  <h1>Rock Paper Scissors</h1>
</header>

<body>


  <div class="result">
    <p>Congratulations <?php echo $_SESSION['uname']; ?> You Win the game!!</p>
    <p>Your Total score is : <?php echo $_SESSION['score']; ?> </p>
  </div>

  <div class="choices" class="reloadBtn">
    <a button type="button" class="btn btn-dark" href="index.php">Restart Game</button></a>
  </div>

</body>

</html>