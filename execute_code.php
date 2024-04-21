<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputJSON = file_get_contents('php://input');
    $inputData = json_encode($inputJSON);

    // Execute the Python script and capture its output
    $pythonCommand = "python my_script.py " . escapeshellarg($inputData);
    $pythonResult = shell_exec($pythonCommand);
    // Send the Python script's output back to the client

    echo json_encode($pythonResult);
}
?>
