<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dimefootwear"; // Replace 'your_database' with your actual database name
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if username exists
if(isset($_POST['username'])) {
    $username = $_POST['username'];
    $sql = "SELECT * FROM site_user WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<p style='color:red;margin-top: 0px;margin-bottom: 0px;'>Username already exists</p>";
    } else {
        echo "<p style='color:green;margin-top: 0px;margin-bottom: 0px;'>Username is available</p>"; // Username is available
    }
}

$conn->close();
?>
