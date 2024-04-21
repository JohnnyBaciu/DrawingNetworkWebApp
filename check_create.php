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
        echo '<body style="background-color: #ff5733; display: flex; justify-content: center; align-items: center; height: 100vh;">';
        echo '<div style="background-color: #fff; color: #ff5733; font-family: sans-serif; padding: 20px; border-radius: 5px; text-align: center;">';
        echo '<h2>Error: Username already exists</h2>';
        echo '</div>';
        echo '</body>';
    } else {

        echo '<form id="redirectForm" action="passwordc.php" method="POST">';
        echo '<input type="hidden" name="inputData" value="' . $inputData . '">';
        echo '</form>';
        echo '<script>';
        echo 'document.getElementById("redirectForm").submit();';
        echo '</script>';    }

    $stmt->close();
}

$mysqli->close();
?>
