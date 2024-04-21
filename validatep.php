<?php
// Simulated validation logic (replace with your actual validation code)
$uzername = $_POST['uzername'];
$pass = $_POST['password'];

// Example validation: Check if username is not empty and password is at least 8 characters long
include "dbconnect.php";

// Element to check (e.g., username)
// SQL query to check if the element exists in the database
$sql = "SELECT * FROM table1 WHERE name = '$uzername'";

$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Get the value from the row
    $value = $row['value'];

    if ($value == $pass) {
        echo "true";
    }
    else{
        echo "false";
    }
}

?>
