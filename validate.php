<?php
// Simulated validation logic (replace with your actual validation code)
$uzername = $_POST['uzername'];

// Example validation: Check if username is not empty and password is at least 8 characters long
include "dbconnect.php";

// Element to check (e.g., username)
// SQL query to check if the element exists in the database
$sql = "SELECT * FROM table1 WHERE name = '$uzername'";

$result = $mysqli->query($sql);

if ($result && $result->num_rows > 0) {
    echo "false"; // Username already exists
} else{
    echo "true"; // Username is available
} 
?>
