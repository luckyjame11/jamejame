<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if username exists
if(isset($_POST['username'])) {
    $username = $_POST['username'];
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "Username already exists";
    }
}

// Check if email exists
if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "Email already exists";
    }
}

$conn->close();
?>
