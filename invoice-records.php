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

// Modify the SQL query to join with the user_delivery_address table and filter by status
$sql = "SELECT orders.order_id, orders.status, users_delivery_address.first_name, users_delivery_address.last_name
        FROM orders
        JOIN users_delivery_address ON orders.address_id = users_delivery_address.address_id
        WHERE orders.status IN ('Returned', 'Delivered')";

$result = $conn->query($sql);
$orders = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

$conn->close();

echo json_encode($orders);
?>
