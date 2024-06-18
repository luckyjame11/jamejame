<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dimefootwear";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve data from POST request
    $serial_id = $_POST['serial_id'] ?? '';
    $name = $_POST['name'] ?? '';
    $brand = $_POST['brand'] ?? '';
    $product_details = $_POST['product_details'] ?? '';
    $classification = $_POST['classification'] ?? '';
    $price = $_POST['price'] ?? '';

    // Prepare update query
    $sql = "UPDATE product SET name=?, brand=?, product_details=?, classification=?, price=? WHERE serial_id=?";

    // Prepare statement
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssssid", $name, $brand, $product_details, $classification, $price, $serial_id);
        
        // Execute statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Product updated successfully";

        } else {
            echo "Error updating product: " . mysqli_error($conn);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>
