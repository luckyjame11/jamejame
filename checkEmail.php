<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dimefootwear"; // Replace 'your_database' with your actual database name
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if email exists
if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $sql = "SELECT * FROM site_user WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<p style='color:red;margin-top: 0px;margin-bottom: 0px;'>Email already exists</p>";
    } else {
        echo "<p style='color:green;margin-top: 0px;margin-bottom: 0px;'>Email is available</p>"; // Email is available
    }
}

$conn->close();
?>
