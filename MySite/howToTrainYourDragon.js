let canvas = document.getElementById("canvas");
let ctx = canvas.getContext("2d");
let dropdown = document.getElementById("animations");
dropdown.addEventListener('change', setState);


const CANVAS_WIDTH = canvas.width = 700;
const CANVAS_HEIGHT = canvas.height = 480;
const SPRITE_WIDTH = canvas.width = 680;
const SPRITE_HEIGHT = canvas.height = 472;
const SPRITE_FRAMES = {
    "idle": {frames: 10},
    "jump": {frames: 12},
    "run": {frames: 8},
    "sleep": {frames: 8},
    "walk": {frames: 10},
};

let playerState = "idle";
let frame = 1;


let playerImage = new Image();
let playerbckImage = new Image();

function setState(pEvent) {
    playerState = pEvent.target.value;
}

function animate() {
    let numOffFrames = SPRITE_FRAMES[playerState].frames;

    playerImage.src = "images/dragon/" + playerState + frame + ".png";
    //playerbckImage.src = "images/72937-OE9HM8-236.jpg";
    playerImage.onload = () => {
        ctx.clearRect(0, 0, CANVAS_WIDTH, CANVAS_WIDTH);
        ctx.drawImage(playerImage, 10, 40, SPRITE_WIDTH, SPRITE_HEIGHT);
        //ctx.drawImage(playerbckImage, 0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);

        if(frame < numOffFrames) {
            frame++;
        }
        else {
            frame = 1;
        }
    }

    setTimeout(function() {requestAnimationFrame(animate);},100);
}

animate();
