<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dimefootwear";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if serial_id exists
if(isset($_POST['serial_id'])) {
    $serial_id = $_POST['serial_id'];
    $sql = "SELECT * FROM product WHERE serial_id='$serial_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<p style='color:red;margin-top: 0px;margin-bottom: 0px;'>Serial already exists</p>";
    } else {
        echo "<p style='color:green;margin-top: 0px;margin-bottom: 0px;'>Serial is available</p>";
    }
}

$conn->close();
?>
