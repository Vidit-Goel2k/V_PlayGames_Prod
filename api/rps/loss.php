<?php
session_start();
require 'C:\xampp\htdocs\cwh\partials\_nav_rps.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>loss</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>

  <header>
	  <h1>Rock Paper Scissors</h1>
  </header>

  <body>

		<div class="result">
			<p>Awww!!! <?php echo $_SESSION['uname']; ?> You lost the game <br> Better luck next time.</p>
      <p>Your Total score is : <?php echo $_SESSION['score']; ?> </p>
		</div>

        <div class="choices" class="reloadBtn">
            <a button type="button" class="btn btn-dark" href="index.php" >Restart Game</button></a>
        </div>
		
  </body>
  
</html>
