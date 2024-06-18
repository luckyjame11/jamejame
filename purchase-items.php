<?php
session_start();

if (empty($_SESSION['userID'])) {
    header('Location: Log-in-Form.php');
    exit;
}

$userID = $_SESSION['userID'];

// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dimefootwear";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve information from the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $total_amount_str = isset($_POST['subTotal']) ? str_replace(',', '', $_POST['subTotal']) : '0.00';
    $total_amount = floatval($total_amount_str);
    $address_id = isset($_POST['addressID']) ? intval($_POST['addressID']) : 0;
    $mode_payment = isset($_POST['mode_payment']) ? $_POST['mode_payment'] : '';
    $status = "Pending";
    $date_delivered = "0000-00-00 00:00:00";

    // Prepare and execute SQL INSERT statement for orders table
    $sql = "INSERT INTO orders (user_id, total_amount, status, address_id, mode_payment, date_delivered) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("idssss", $userID, $total_amount, $status, $address_id, $mode_payment, $date_delivered);
    $stmt->execute();

    // Check if insertion was successful
    if ($stmt->affected_rows > 0) {
        $order_id = $stmt->insert_id; // Get the ID of the inserted order

        // Prepare SQL INSERT statement for order_items table
        $sql = "INSERT INTO order_items (user_id, order_id, serial_id, quantity, price, size) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_items = $conn->prepare($sql);

        // Bind parameters
        $stmt_items->bind_param("iidids", $userID, $order_id, $serial_id, $quantity, $price, $size);

        // Execute for each item
        $items = $_POST['items']; // Assuming 'items' is an array containing the item details
        $all_items_successful = true;

        foreach ($items as $item) {
            $serial_id = $item['serial_id'];
            $quantity = $item['quantity'];
            $price = floatval(str_replace(',', '', $item['price'])); // Remove commas and convert to float
            $size = $item['size'];
            $cart_id = $item['cart_id']; // Get cart_id

            // Format price to have 2 decimal places (optional)
            $price = number_format($price, 2, '.', ''); 

            // Debugging statements
            echo "Serial ID: $serial_id, Quantity: $quantity, Price: $price, Size: $size <br>";

            // Execute the prepared statement for each item
            $stmt_items->execute();

            // Check if insertion was successful for each item
            if ($stmt_items->affected_rows <= 0) {
                echo "Error saving order item details.";
                $all_items_successful = false;
                break; // Exit loop if an error occurs
            } else {
                // Update shoe_stocks table
                $sql_update_stock = "UPDATE shoe_stocks SET quantity = quantity - ? WHERE serial_id = ? AND size = ?";
                $stmt_update_stock = $conn->prepare($sql_update_stock);
                $stmt_update_stock->bind_param("iis", $quantity, $serial_id, $size);
                $stmt_update_stock->execute();

                // Check if stock update was successful
                if ($stmt_update_stock->affected_rows <= 0) {
                    echo "Error updating stock quantity.";
                    $all_items_successful = false;
                    break; // Exit loop if an error occurs
                }
            }
        }

        if ($all_items_successful) {
            // Prepare SQL DELETE statement for cart table
            $sql_delete_cart = "DELETE FROM cart WHERE cart_id = ?";
            $stmt_delete_cart = $conn->prepare($sql_delete_cart);
            $stmt_delete_cart->bind_param("i", $cart_id);

            // Execute the prepared statement for each item
            foreach ($items as $item) {
                $cart_id = $item['cart_id']; // Get cart_id
                $stmt_delete_cart->execute();

                // Check if deletion was successful for each item
                if ($stmt_delete_cart->affected_rows <= 0) {
                    echo "Error removing item from cart.";
                    break; // Exit loop if an error occurs
                }
            }

            // echo "Order details saved and items removed from cart successfully!";
            header('Location:success-purchase.php');
        } else {
            echo "Error processing order items.";
        }
    } else {
        echo "Error saving order details.";
    }

    // Close the statements
    $stmt->close();
    $stmt_items->close();
    $stmt_update_stock->close();
    $stmt_delete_cart->close(); // Close the cart delete statement
}

// Close the database connection
$conn->close();
?>
