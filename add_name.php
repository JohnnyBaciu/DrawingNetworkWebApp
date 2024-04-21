
<?php
include "dbconnect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newname = $_POST['inputData'];
    $newvalue = $_POST['moreData'];
}
else {
    echo "<h2>Error: Invalid Request</h2>";}

// Element to check (e.g., username)
// SQL query to check if the element exists in the database
$sql = "SELECT * FROM table1 WHERE name = '$newname'";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Get the value from the row
    $value = $row['value'];

    // Get the length of the value
    $valueLength = strlen($value);
    if ($value == $newvalue) {

        $htmlContent = $newname; 
        include "grid.php";
        exit;
    }
    else{
        include "wrong.html";
        exit;
    }
} else {
    $sql = "INSERT INTO table1(ID, name, value) VALUES (NULL,'$newname','$newvalue')";
    $result = $mysqli->query($sql) or die(mysqli_error($mysqli));
}


$newname = addslashes($newname);
$newvalue = addslashes($newvalue);



include "404.html";

?>

