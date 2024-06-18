<?php
// Include the database configuration file
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dimefootwear";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

// Set the content type to JSON
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the serial_id from the request
    $input = json_decode(file_get_contents("php://input"), true);
    if (isset($input['serial_id'])) {
        $serial_id = $input['serial_id'];

        // Begin transaction
        $conn->begin_transaction();

        try {
            // Prepare the SQL delete statements
            // $deleteOrderItemsSql = "DELETE FROM order_items WHERE serial_id = ?";
            $deleteStocksSql = "DELETE FROM shoe_stocks WHERE serial_id = ?";
            $deleteProductSql = "DELETE FROM product WHERE serial_id = ?";

            // Prepare and execute the delete order items statement
            // if ($stmt = $conn->prepare($deleteOrderItemsSql)) {
            //     $stmt->bind_param("i", $serial_id);
            //     if (!$stmt->execute()) {
            //         throw new Exception('Failed to delete order items: ' . $stmt->error);
            //     }
            //     $stmt->close();
            // } else {
            //     throw new Exception('Failed to prepare SQL statement for order items: ' . $conn->error);
            // }

            // Prepare and execute the delete stocks statement
            if ($stmt = $conn->prepare($deleteStocksSql)) {
                $stmt->bind_param("i", $serial_id);
                if (!$stmt->execute()) {
                    throw new Exception('Failed to delete stocks: ' . $stmt->error);
                }
                $stmt->close();
            } else {
                throw new Exception('Failed to prepare SQL statement for stocks: ' . $conn->error);
            }

            // Prepare and execute the delete product statement
            if ($stmt = $conn->prepare($deleteProductSql)) {
                $stmt->bind_param("i", $serial_id);
                if (!$stmt->execute()) {
                    throw new Exception('Failed to delete product: ' . $stmt->error);
                }
                $stmt->close();
            } else {
                throw new Exception('Failed to prepare SQL statement for product: ' . $conn->error);
            }
            // Commit transaction
            $conn->commit();
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            // Rollback transaction in case of error
            $conn->rollback();
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }

    } else {
        echo json_encode(['success' => false, 'message' => 'Serial ID not provided']);
    }

    // Close the database connection
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
