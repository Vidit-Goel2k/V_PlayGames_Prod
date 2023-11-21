<?php
session_start();
if($_SESSION['ttt_status']==0){
	header("location: /CWH/game_list.php?alert=unavailable");
}

require 'C:\xampp\htdocs\CWH\partials\_nav_rps.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Tic Tac Toe</title>
    <link rel="stylesheet" href="C:\xampp\htdocs\cwh\rps\style.css">
</head>
<body>
    <nav>
        <ul>
            Tic Tac Toe
        </ul>
    </nav>
    <div class="gamecontainer">
        <div class="container">
            <div class="line"> </div>
            <div class="box  bl-0 bt-0"><span class="boxtext"></span></div>
            <div class="box bt-0"><span class="boxtext"></span></div>
            <div class="box bt-0 br-0"><span class="boxtext"></span></div>
            <div class="box bl-0"><span class="boxtext"></span></div>
            <div class="box"><span class="boxtext"></span></div>
            <div class="box br-0"><span class="boxtext"></span></div>
            <div class="box  bb-0 bl-0 "><span class="boxtext"></span></div>
            <div class="box  bb-0"><span class="boxtext"></span></div>
            <div class="box bb-0  br-0"><span class="boxtext"></span></div>
        </div>
        <div class="gameinfo">
            <h1>Welcome to tic tac toe world</h1>
            <div>
                <span class="info">Turn for x </span>
                <button  id="reset">Reset</button> 
            </div>
            <div class="imgbox">
                <img src="ttt_Partials\excited.gif" alt="excited Gifs">
             </div>
        </div>
    </div>
    <script src="ttt_script.js"></script>
</body>
</html>