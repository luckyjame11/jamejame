<?php
session_start();
if(isset($_POST['userId'], $_POST['serial_id'], $_POST['size'])) {
    $userId = $_POST['userId'];
    $serialId = $_POST['serial_id'];
    $size = $_POST['size'];
    
    // Now you can perform your database insertion query here
    // Example: Inserting into a 'cart' table
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dimefootwear";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "INSERT INTO cart (id, serial_id, size) VALUES ('$userId', '$serialId', '$size')";
    
    if ($conn->query($sql) === TRUE) {
        // Set session variable to indicate successful addition to cart
        $_SESSION['cartItemAdded'] = true;
        
        // Redirect back to product-details.php
        header('Location: product-details.php?id=' . $serialId);
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
} else {
    echo "Missing parameters";
}
?>
