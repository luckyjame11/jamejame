<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dimefootwear";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchName = isset($_GET['searchName']) ? $_GET['searchName'] : '';
$searchSerial = isset($_GET['searchSerial']) ? $_GET['searchSerial'] : '';

$sql = "SELECT p.serial_id, p.name, p.brand FROM product p 
        LEFT JOIN (
            SELECT serial_id, MIN(size) AS size FROM shoe_stocks WHERE quantity > 30 GROUP BY serial_id
        ) s ON p.serial_id = s.serial_id";


if (!empty($searchName)) {
    $sql .= " WHERE p.name LIKE '%" . $conn->real_escape_string($searchName) . "%'";
}

if (!empty($searchSerial)) {
    $sql .= " WHERE p.serial_id LIKE '%" . $conn->real_escape_string($searchSerial) . "%'";
}

$result = $conn->query($sql);
$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();

echo json_encode($products);
?>
