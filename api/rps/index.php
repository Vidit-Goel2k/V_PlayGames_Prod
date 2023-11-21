<?php
session_start();
if($_SESSION['rps_status']==0){
	header("location: /CWH/game_list.php?alert=unavailable");
}

require 'C:\xampp\htdocs\CWH\partials\_nav_rps.php';
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<title>RPS</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<header>
	<h1>Rock Paper Scissors</h1>
</header>

<body>


	<div class="score-board">
		<div id="user-label" class="badge"><?php echo $_SESSION['uname']; ?></div>
		<div id="computer-label" class="badge">Computer</div>
		<span id="user-Score">0</span>:<span id="computer-Score">0</span>
	</div>

	<div class="result">
		<p>Let's Go !</p>
	</div>

	<div class="choices">

		<div class="choice" id="rock">
			<img src="images/Rock.png" alt="Rock">
		</div>

		<div class="choice" id="paper">
			<img src="images/Paper.png" alt="Paper">
		</div>

		<div class="choice" id="scissors">
			<img src="images/Scissors.png" alt="Scissors">
		</div>

	</div>

	<p id="action-message">Choose your hand.</p>



	<script src="script.js.php"></script>
</body>
<footer>
	<p>
		Made by Vidit Goel.
	</p>
</footer>

</html>