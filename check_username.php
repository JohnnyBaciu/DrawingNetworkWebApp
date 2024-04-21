<?php
// Assuming you have a database connection established already
include "dbconnect.php";
if ($mysqli->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputData = $_POST['inputData'];

    // Prepare a statement to check if the username exists
    $stmt = $mysqli->prepare("SELECT * FROM table1 WHERE name = ?");
    $stmt->bind_param("s", $inputData);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Username exists, create a hidden form and auto-submit it using JavaScript
        echo '<form id="redirectForm" action="password.php" method="POST">';
        echo '<input type="hidden" name="inputData" value="' . $inputData . '">';
        echo '</form>';
        echo '<script>';
        echo 'document.getElementById("redirectForm").submit();';
        echo '</script>';
    } else {
        // Username doesn't exist, display an error message
        echo '<body style="background-color: #ff5733; display: flex; justify-content: center; align-items: center; height: 100vh;">';
        echo '<div style="background-color: #fff; color: #ff5733; font-family: sans-serif; padding: 20px; border-radius: 5px; text-align: center;">';
        echo '<h2>Error: Username doesn\'t exists</h2>';
        echo '</div>';
        echo '</body>';    }

    $stmt->close();
}

$mysqli->close();
?>
