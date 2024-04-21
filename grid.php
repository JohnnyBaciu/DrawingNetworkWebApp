<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Canvas Drawing</title>
<style>
    html, body {
        background-color: #ff5733;
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column; /* Stack elements vertically */
        justify-content: center;
        align-items: center;
        text-align: center;
        line-height: 0.3;
        font-family: Arial, Helvetica, sans-serif;

    }
    #a{
        margin: 0 auto;
        padding: 0px;
    }
    canvas {
        border: 1px solid black;
        background-color: #ffffff;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 5px;
        background-color: #4CAF50;
        color: white;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        cursor: pointer;
        border: none;
        margin: 5px;
    }

    /* Hover effect */
    .btn:hover {
        background-color: #45a049;
    }

</style>
<?php
    echo '<div><h1 style="padding: 0px;" id="welcome" > Welcome ' . $htmlContent . '</h1></div>';
?>
<div><h1 style="padding: 0px;">Draw a </h1><h5 style="line-height: 1.5; padding-left: 5px; padding-right: 5px;">anvil, sun, eyeglasses, baseball bat, ladder, book, dumbell, grapes, laptop, or drums</h5></div>


</head>
<body>
<canvas id="drawingCanvas" width="280" height="280"></canvas>
<button class="btn" onclick="clearCanvas()">Clear Canvas</button>
<button class="btn" onclick="saveAsList()">GUESS</button>
<div id="a"><h1 id="output" style="line-height: 1.2;"></h1></div>
<script>
    const canvas = document.getElementById('drawingCanvas');
    const ctx = canvas.getContext('2d', { willReadFrequently: true });
    let isDrawing = false;
    let lastX = 0;
    let lastY = 0;

    // Mouse event listeners
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);

    // Touch event listeners
    canvas.addEventListener('touchstart', startDrawing);
    canvas.addEventListener('touchmove', handleTouchMove);
    canvas.addEventListener('touchend', stopDrawing);

    function startDrawing(e) {
        isDrawing = true;
        [lastX, lastY] = [e.clientX - canvas.offsetLeft, e.clientY - canvas.offsetTop];
        e.preventDefault(); // Prevent default touch behavior
    }

    function draw(e) {
        if (!isDrawing) return;
        ctx.strokeStyle = 'blue';
        ctx.lineWidth = 8; // Adjust line width here
        ctx.lineJoin = 'round';
        ctx.lineCap = 'round';
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(e.clientX - canvas.offsetLeft, e.clientY - canvas.offsetTop);
        ctx.stroke();
        [lastX, lastY] = [e.clientX - canvas.offsetLeft, e.clientY - canvas.offsetTop];
    }

    function handleTouchMove(e) {
        if (!isDrawing) return;
        draw(e.touches[0]); // Use the first touch point for drawing
        e.preventDefault(); // Prevent scrolling on touch devices
    }

    function stopDrawing() {
        isDrawing = false;
    }

    function clearCanvas() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    function saveAsList() {
    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    const pixels = imageData.data;
    let finalList = [];

    // Scale factors for reducing canvas to 28x28
    const scaleX = canvas.width / 28;
    const scaleY = canvas.height / 28;

    for (let i = 0; i < 28; i++) {
        for (let j = 0; j < 28; j++) {
            let sum = 0;
            for (let k = 0; k < scaleX; k++) {
                for (let l = 0; l < scaleY; l++) {
                    let x = Math.floor(j * scaleX + l);
                    let y = Math.floor(i * scaleY + k);
                    let index = (y * canvas.width + x) * 4;
                    let h = Math.round(
                        (pixels[index] + pixels[index + 1] + pixels[index + 2]) / 3 // Average RGB values
                    );
                    sum += h;
                }
            }
            // Normalize sum to be between 0 and 255
           if (sum !==0){finalList.push(1);}
           else{finalList.push(0);}
        }
    }
    
    console.log(finalList.length); // Should be 784
    console.log(finalList);
    let namejson = String('<?php echo $htmlContent; ?>');
    send(finalList, namejson);
    let lastX = 0;
    let lastY = 0;
}

function send(finalList, namejson){
    fetch('execute_code.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                

                body: JSON.stringify({ userInput: finalList, name: namejson}),

            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('output').textContent = "Prediction is: " + data;
            });
        }

</script>
</body>
</html>
