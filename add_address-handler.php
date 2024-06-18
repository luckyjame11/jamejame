<?php
session_start();
$_SESSION['userID'];  
// Check if the user is logged in
if(empty($_SESSION['loggedUser'])) {
    header('Location: Log-in-Form.php');
    exit;
}

// Include database connection
require 'db_connection.php';

// Retrieve the form data
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$contact_number = $_POST['contact_number'];
$address = $_POST['address'];
$zip_code = $_POST['zipcode'];
$region = $_POST['region'];
$city_municipality = $_POST['city'];
$province = $_POST['province'];

// Get the logged-in user ID from the session
$loggedUserId = $_SESSION['userID'];

// Validate the form data (this is a simple validation, you may need to enhance it)
if (empty($first_name) || empty($last_name) || empty($contact_number) || empty($address) || empty($zip_code) || empty($region) || empty($city_municipality) || empty($province)) {
    echo "All fields are required.";
    exit;
}

// Insert the data into the database
$sql = "INSERT INTO users_delivery_address (id, first_name, last_name, address, zip_code, region, city_municipality, province, contact_number) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("isssssssi", $loggedUserId, $first_name, $last_name, $address, $zip_code, $region, $city_municipality, $province, $contact_number);

if ($stmt->execute()) {
    // Redirect to another page if needed
    header('Location: myAccount.php');
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
