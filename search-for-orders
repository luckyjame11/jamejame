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

$sql = "SELECT serial_id, name, brand FROM product";
if (!empty($searchName)) {
    $sql .= " WHERE name LIKE '%" . $conn->real_escape_string($searchName) . "%'";
}
if (!empty($searchSerial)) {
    $sql .= (!empty($searchName) ? " AND" : " WHERE") . " serial_id LIKE '%" . $conn->real_escape_string($searchSerial) . "%'";
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
