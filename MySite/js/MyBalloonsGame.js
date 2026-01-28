let score = 0;
let yellowBalloon = 0;
let redBalloon = 0;
//let balloonImg = document.getElementById("yellowBalloon");
//let restartButton = document.getElementById("restart");
let scoreBoard = document.getElementById("scoreBoard");
let clickMeImg = document.getElementById("clickMe");
let message = document.getElementById("balloonsGallery")

document.addEventListener('mousedown', startGame);
restartButton.addEventListener('mousedown', restartGame);
clickMeImg.addEventListener('mousedown', clickOnMe);

function startGame(pEvent) {
    if (pEvent.target.className == "yellowBalloon") {
        pEvent.target.style.visibility = "hidden";
        score = score + 1;
        scoreBoard.textContent = score;
        yellowBalloon = yellowBalloon + 1;
        //endGame()
    } else if (pEvent.target.className == "redBalloon") {
        pEvent.target.style.visibility = "hidden";
        score = score - 1;
        scoreBoard.textContent = score;
        redBalloon = redBalloon + 1;
        alert("You should click on the yellow balloon");
    }
    endGame();

}

function endGame() {
    if (score == 6) {
        message.textContent = "Well done ! You won";
        message.style.background = "green";
    }
    if (redBalloon == 1) {
        message.textContent = "you choose a redBallon! please try again";
        message.style.background = "red";
    }
}

function restartGame(pEvent) {
    //balloonImg.style.visibility = "visible";
    //score = 0;
    //scoreBoard.textContent = score;
    location.reload();
}

function clickOnMe() {
    alert("Welcome to the balloons game");
}
