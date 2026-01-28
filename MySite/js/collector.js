const CANVAS = document.getElementById('canvas');
const CTX = CANVAS.getContext('2d');
const GAME_OVER_IMG_WIDTH = 960;
const GAME_OVER_IMG_HEIGHT = 574;
const GAME_OVER_IMG = new Image();
GAME_OVER_IMG.src = "./images/collector/GameOverMessage.png";
const BG_IMG = new Image();
BG_IMG.src = "./images/collector/bgImage.png";

const PLAYER = {
    img: new Image(),
    x: 500,
    y: 200,
    width: 25,
    height: 45,
    enlarge: 2.5,
    face: {
        "up": "./images/collector/yuki/up.png",
        "down": "./images/collector/yuki/down.png",
        "left": "./images/collector/yuki/left.png",
        "right": "./images/collector/yuki/right.png",
    },
    speed: 10,
};

PLAYER.img.src = PLAYER.face["down"];

const KEYS = {
    "ArrowUp": false,
    "ArrowDown": false,
    "ArrowLeft": false,
    "ArrowRight": false,
    "a": false,
};

updateCanvasSize();
window.onresize = updateCanvasSize();

let gameOverImgX = CANVAS.width / 2 - GAME_OVER_IMG_WIDTH / 2;
let gameOverImgY = CANVAS.height / 2 - GAME_OVER_IMG_HEIGHT / 2; 
let time = 100;
let gameOn = true;

let pokemon1 = new Figure(CTX, "./images/collector/pokemons/pokemon1.png", "pikachu", 0.3);
let pokemon2 = new Figure(CTX, "./images/collector/pokemons/pokemon2.png", "giglipah", 0.3);
let pokemon3 = new Figure(CTX, "./images/collector/pokemons/pokemon3.png", "balbuzaur", 0.5);
let pokemonsGroup = [pokemon1, pokemon2, pokemon3];

document.addEventListener('keydown', (event) => handleKey(event, true)); // Activation
document.addEventListener('keyup', (event) => handleKey(event, false)); // Désactivation

let bomb1 = new Figure(CTX, "./images/collector/bomb.png", "bomb", 0.1);

// Demander le nom de l'utilisateur
let userName = prompt("Quel est votre nom ?");

function updateCanvasSize() {
    CANVAS.width = CANVAS.clientWidth;
    CANVAS.height = CANVAS.clientWidth * 0.5;
}

function writeText(text = "TEXT", color = "black", size = "30", font = "Arial", style = "", x = CANVAS.width / 2, y = CANVAS.height / 2) {
    CTX.font = style + " " + size + "px " + font;
    CTX.fillStyle = color;
    CTX.fillText(text, x, y);
}

function timer() {
    if (time > 0){
        time--;
    }
    else{
        gameOver();
    }
}

function gameLoop() {
    if (gameOn) {
        CTX.clearRect(0, 0, CANVAS.width, CANVAS.height); // Nettoyage du canvas
        CTX.drawImage(BG_IMG, 0, 0, CANVAS.width, CANVAS.height);

        writeText("Time: " + time, "black", 50, undefined, "bold", 1000, 70);
        writeText("Name: " + userName, "black", 50, undefined, "bold", 100, 70);
        controlPlayerMove();
        drawFigure(PLAYER);

        pokemonsGroup.forEach(pokemon => pokemon.draw());
        bomb1.draw();

        requestAnimationFrame(gameLoop);
    }
}

function gameOver() {
    gameOn = false;
    CTX.clearRect(0, 0, CANVAS.width, CANVAS.height);
    CTX.drawImage(GAME_OVER_IMG, gameOverImgX, gameOverImgY, GAME_OVER_IMG_WIDTH, GAME_OVER_IMG_HEIGHT);
}

function handleKey(event, isPressed) {
    if (event.key in KEYS) {
        KEYS[event.key] = isPressed;
    }
}

function controlPlayerMove() {
    if (KEYS["ArrowUp"] && PLAYER.y > 0) {
        PLAYER.y -= PLAYER.speed;
        PLAYER.img.src = PLAYER.face["up"];
    }
    if (KEYS["ArrowLeft"] && PLAYER.x > 0) {
        PLAYER.x -= PLAYER.speed;
        PLAYER.img.src = PLAYER.face["left"];
    }
    if (KEYS["ArrowDown"] && PLAYER.y < CANVAS.height - PLAYER.height * PLAYER.enlarge) {
        PLAYER.y += PLAYER.speed;
        PLAYER.img.src = PLAYER.face["down"];
    }

    if (KEYS["ArrowRight"] && PLAYER.x < CANVAS.width - PLAYER.width * PLAYER.enlarge) {
        PLAYER.x += PLAYER.speed;
        PLAYER.img.src = PLAYER.face["right"];
    }
        if (KEYS["a"] && PLAYER.x < CANVAS.length) {
        PLAYER.x += PLAYER.speed;
        PLAYER.img.src = PLAYER.face["ouais mais c'est lui pas moi  ok oui merci"];
    }
};

gameLoop();
setInterval(timer, 1000);
