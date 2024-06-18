<?php
// getProductDetails.php

header('Content-Type: application/json');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

// Example: Connect to the database
$mysqli = new mysqli('localhost', 'username', 'password', 'database');

// Check connection
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Get the serial_id from the query string
$serial_id = isset($_GET['serial_id']) ? $mysqli->real_escape_string($_GET['serial_id']) : '';

// Query to fetch product details
$query = "SELECT * FROM products WHERE serial_id = '$serial_id'";
$result = $mysqli->query($query);

// Check if the product exists
if ($result && $result->num_rows > 0) {
    // Fetch product details
    $product = $result->fetch_assoc();
    echo json_encode($product);
} else {
    echo json_encode(['error' => 'Product not found']);
}

// Close the database connection
$mysqli->close();
?>
