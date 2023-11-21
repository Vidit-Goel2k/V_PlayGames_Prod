<?php
header('Content-Type: application/javascript');
?>

<!-- <script type="text/javascript"> -->

document.addEventListener('DOMContentLoaded', () => {
   
<?php
session_start();
?>

<!--  Caching the DOM  -->
let userScore = 0;
let computerScore = 0;
let moves = 0;
const userScore_span=document.getElementById("user-Score");
const computerScore_span=document.getElementById("computer-Score");
const scoreBoard_div= document.querySelector(".score-board");
const result_p= document.querySelector(".result>p");
const rock_div=document.getElementById("rock");
const paper_div=document.getElementById("paper");
const scissors_div=document.getElementById("scissors");

function gameOver(){
  
  const result = document.querySelector('.result');
  const reloadBtn = document.querySelector('.reload');

  if(userScore > computerScore){
	window.location.href = "win.php";
  }
  else if(userScore < computerScore){
	window.location.href = "loss.php";
  }
  
}


<!-- // Getting random input from computer -->
function getComputerChoice(){
	const choices = ["rock","paper","scissors"];
	const randomNumber=Math.floor(Math.random()*3);
	return(choices[randomNumber]);
}

<!-- // functions for handling win, loss and draw -->
function win(userChoice, computerChoice){
	const smallUserWord = "<?php echo $_SESSION['uname']; ?>".fontsize(3).sub();
	const smallCompWord = "comp".fontsize(3).sub();
	userScore++;
	moves++;
	if(moves >= 3){
		gameOver();
	}
	userScore_span.innerHTML = userScore;
	computerScore_span.innerHTML = computerScore;
	result_p.innerHTML =`${userChoice}${smallUserWord} beats ${computerChoice}${smallCompWord}. YOU WIN ! `;
	document.getElementById(userChoice).classList.add('green-glow');
	setTimeout(function(){document.getElementById(userChoice).classList.remove('green-glow')},500);
}

function lose(userChoice, computerChoice){
	computerScore++;
	moves++;
	if(moves >= 3){
		gameOver();
	}
	userScore_span.innerHTML = userScore;
	computerScore_span.innerHTML = computerScore;
	const smallUserWord = "<?php echo $_SESSION['uname']; ?>".fontsize(3).sub();
	const smallCompWord = "comp".fontsize(3).sub();
	result_p.innerHTML =`${userChoice}${smallUserWord} loses to ${computerChoice}${smallCompWord}. YOU LOST ! `;
	document.getElementById(userChoice).classList.add('red-glow');
	setTimeout(function(){document.getElementById(userChoice).classList.remove('red-glow')},500);
}

function draw(userChoice, computerChoice){
	const smallUserWord = "<?php echo $_SESSION['uname']; ?>".fontsize(3).sub();
	const smallCompWord = "comp".fontsize(3).sub();
	result_p.innerHTML =`${userChoice}${smallUserWord} equals ${computerChoice}${smallCompWord}. ITS A DRAW .`;
	document.getElementById(userChoice).classList.add('gray-glow');
	setTimeout(function(){document.getElementById(userChoice).classList.remove('gray-glow')},500);
}


<!-- // Game  -->
function game(userChoice){
	const computerChoice= getComputerChoice();
	switch(userChoice + computerChoice){
		<!-- when user wins -->
		case "rockscissors":
		case "paperrock":
		case "scissorspaper":
			win(userChoice, computerChoice);
			break;
		<!-- when user loses -->
		case "rockpaper":
		case "paperscissors":
		case "scissorsrock":
			lose(userChoice, computerChoice);
			break;
		<!-- when there is a tie -->
		case "rockrock":
		case "paperpaper":
		case "scissorsscissors":
			draw(userChoice, computerChoice);
			break;
	}
}

function main() {

	if(userScore >= 3 ){
		alert("You win");
	}
	if(computerScore >= 3 ){
		alert("You Loose");
	}

	rock_div.addEventListener('click', function(){
		game("rock");
	})

	paper_div.addEventListener('click', function(){
		game("paper");
	})

	scissors_div.addEventListener('click', function(){
		game("scissors");
	})
}

main();

})

<!-- </script> -->