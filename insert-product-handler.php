<?php
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Include your database connection file
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dimefootwear";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare an SQL statement for insertion into product table
    $sql = "INSERT INTO product (serial_id, name, brand, product_details, classification, price, main_image, sub_image2, sub_image3, sub_image4, sub_image5) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("issssssssss", $serial_id, $name, $brand, $product_details, $classification, $price, $main_image, $sub_image2, $sub_image3, $sub_image4, $sub_image5);

        // Set parameters
        $serial_id = $_POST['productNumber'];
        $name = $_POST['productName'];
        $brand = $_POST['brand'];
        $product_details = $_POST['product-details']; // Make sure the name attribute matches the form
        $classification = $_POST['classification'];
        $price = $_POST['price'];
        $main_image = $_FILES['mainImage']['name'];
        $sub_image2 = $_FILES['subImages']['name'][0];
        $sub_image3 = $_FILES['subImages']['name'][1];
        $sub_image4 = $_FILES['subImages']['name'][2];
        $sub_image5 = $_FILES['subImages']['name'][3];

        // Move uploaded files to a permanent location
        $uploadDir = 'img/products/';
        move_uploaded_file($_FILES['mainImage']['tmp_name'], $uploadDir . $main_image);
        move_uploaded_file($_FILES['subImages']['tmp_name'][0], $uploadDir . $sub_image2);
        move_uploaded_file($_FILES['subImages']['tmp_name'][1], $uploadDir . $sub_image3);
        move_uploaded_file($_FILES['subImages']['tmp_name'][2], $uploadDir . $sub_image4);
        move_uploaded_file($_FILES['subImages']['tmp_name'][3], $uploadDir . $sub_image5);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Product added successfully, now insert data to the shoe_stocks table
            $stock_sql = "INSERT INTO shoe_stocks (serial_id, size, quantity) VALUES (?, ?, 0)";

            // Prepare the stock statement
            if ($stock_stmt = $conn->prepare($stock_sql)) {
                // Bind serial_id and size variables to the prepared statement as parameters
                $stock_stmt->bind_param("id", $serial_id, $size);

                // Set the serial_id parameter
                $serial_id = $_POST['productNumber'];

                // Sizes array
                $sizes = [7, 7.5, 8, 8.5, 9, 9.5, 10, 10.5, 11, 11.5];

                // Execute the stock statement for each size
                foreach ($sizes as $size) {
                    $stock_stmt->execute();
                }

                echo "<script>
                alert('Product Added Successfully!');
                window.location.href = 'admin-add-product.php'; // Redirect to add product page
                </script>";
            } else {
                echo "Error preparing stock statement: " . $conn->error;
            }
            // Close the stock statement
            $stock_stmt->close();
        } else {
            echo "Error inserting product: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
