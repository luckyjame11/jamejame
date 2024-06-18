<?php
session_start();

if (empty($_SESSION['userID'])) {
    header('Location: Log-in-Form.php');
    exit;
}

// Connect to your database (replace with your actual database connection code)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dimefootwear";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $cart_id = intval($_GET['id']);
    $userID = $_SESSION['userID'];

    // Delete the item from the cart
    $sql = "DELETE FROM cart WHERE cart_id = ? AND id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $cart_id, $userID);

    if ($stmt->execute()) {
        // Redirect back to the cart page
        header('Location: mycart.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
