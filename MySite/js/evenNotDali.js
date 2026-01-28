let canvas = document.getElementById("canvas");
let ctx = canvas.getContext("2d");

let isDrawing = false;
let drawColor = "black";
let drawWidth = "2"
let restoreArray = [];
let index = -1;

canvas.addEventListener("mousedown", start);
canvas.addEventListener("mousemove", draw);
canvas.addEventListener("mouseup", stopDraw);
canvas.addEventListener('mouseout', stopDraw);
updateCanvasSize();
/*fix_dpi()*/

/*window.onresize = updateCanvasSize();*/
window.onresize = saveData;

function saveData() {
    let imgData =ctx.getImageData(0, 0, canvas.width, canvas.height);
    updateCanvasSize(); 
    ctx.putImageData(imgData, 0, 0);
}


function start(pEvent) {
    isDrawing = true;
    ctx.beginPath();
    //ctx.moveTo(pEvent.clientX, pEvent.clientY);
    ctx.moveTo(pEvent.clientX - canvas.getBoundingClientRect().left, 
        pEvent.clientY - canvas.getBoundingClientRect().top);
}

function draw(pEvent) {
    if (isDrawing) {
        //ctx.lineTo(pEvent.clientX, pEvent.clientY);
        ctx.lineTo(pEvent.clientX - canvas.getBoundingClientRect().left, 
               pEvent.clientY - canvas.getBoundingClientRect().top);
        ctx.strokeStyle = drawColor;
        ctx.lineCap = "round";
        ctx.lineJoin = "round";
        ctx.lineWidth = drawWidth;
        ctx.stroke();
    }
    
}

function updateCanvasSize() {
    canvas.width = canvas.clientWidth;
    canvas.height = canvas.clientWidth * 0.5;
}

function changeColor(pElement) {
    drawColor = pElement.style.background;
}
function stopDraw() {
    isDrawing = false;

    if(pEvent.type != 'mouseout'){
        restoreArray.push(ctx.getImageData(0, 0, canvas.width, canvas.height));
        console.log("restoreArray: " + restoreArray);
        index = index + 1;
   }
}

function clearCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = "white";

    restoreArray = [];
    index = -1;
}

function saveImage() {
    let dataUrl = canvas.toDataURL("image/png");
    console.log("dataUrl: " + dataUrl);

    let downloadLink = document.createElement('a');
    downloadLink.href = dataUrl;
    downloadLink.download = "myPaint.png";
    downloadLink.click();
    downloadLink.delete;

}

function undoLast() {
    if (index <= 0) {
        clearCanvas();
    }
    else {
        index = index-1;
        restoreArray.pop();
        ctx.putImageData(restoreArray[index], 0, 0);
    }
}