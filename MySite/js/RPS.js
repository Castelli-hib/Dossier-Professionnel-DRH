let rockDiv = document.getElementById("rockDiv");
let paperDiv = document.getElementById("paperDiv");
let scissorsDiv = document.getElementById("scissorsDiv");
let userScoreSpan = document.getElementById("userScore");
let computerScoreSpan = document.getElementById("computerScore");
let gameround
let options = ['rock', 'paper', 'scissors'];
let userScore = 0;
let computerScore = 0;


rockDiv.addEventListener("mousedown", function () { startGame("rock") })
paperDiv.addEventListener("mousedown", function () { startGame("paper") })
scissorsDiv.addEventListener("mousedown", function () { startGame("scissors") })


rockDiv.addEventListener("mouseover", hoverIsOn);
rockDiv.addEventListener("mouseout", hoverIsOff);
paperDiv.addEventListener("mouseover", hoverIsOn);
paperDiv.addEventListener("mouseout", hoverIsOff);
scissorsDiv.addEventListener("mouseover", hoverIsOn);
scissorsDiv.addEventListener("mouseout", hoverIsOff);

function hoverIsOn(pEvent) {
    if (pEvent.target.className == "rps") {
        pEvent.target.style.backgroundColor = 'black';
        pEvent.target.style.transition = "0.2s";
        pEvent.target.style.cursor = "pointer";
        pEvent.target.style.border = "6px solid yellow";
    }

}

function hoverIsOff(pEvent) {
    if (pEvent.target.className == "rps") {
        pEvent.target.style.backgroundColor = 'Transparent';
        pEvent.target.style.border = "2px solid black";
    }

}

function startGame(pUserSelection) {
    let userChoice = pUserSelection;
    console.log("user:" + userChoice)

    let randomNumber = Math.floor(Math.random() * 3);
    console.log("random Number:" + randomNumber);

    let computerChoice = options[randomNumber];
    console.log("Computer:" + computerChoice);
    rockPaperScissors(userChoice, computerChoice);

}

function rockPaperScissors(puserChoise, pcomputerChoise) {
    let result = puserChoise + pcomputerChoise;
    if (result == 'rockrock' || result == 'paperpaper' || result == 'scissorsscossors') {
        console.log("It's a draw");
        message.textContent = "It's a draw";
    }

    if (result == 'rockscissors' || result == 'scissorspaper' || result == 'paperrock') {
        console.log("you Won");
        message.textContent = "You Won";
        userScore = userScore + 1;
        userScoreSpan.textContent = userScore;
    }

    if (result == 'scissorsrock' || result == 'aperscissors' || result == 'rockpaper') {
        console.log("You Lost");
        message.textContent = "Not so bad but not enough.Try again";
        computerScore = computerScore + 1;
        computerScoreSpan.textContent = computerScore;
    }
}