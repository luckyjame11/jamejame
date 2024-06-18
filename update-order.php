<?php
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderID = isset($_POST['orderID']) ? intval($_POST['orderID']) : 0;
    $status = isset($_POST['searchStatusSelect']) ? $_POST['searchStatusSelect'] : '';

    if ($orderID > 0 && !empty($status)) {
        $query = "UPDATE orders SET status = ?";
        // If the status is 'Delivered', update the delivered date to the current date
        if ($status === 'Delivered') {
            $query .= ", date_delivered = CURDATE()";
        } elseif ($status === 'Returned') {
            $query .= ", date_delivered = CURDATE()";
        }
        $query .= " WHERE order_id = ?";
        
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'si', $status, $orderID);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Order status updated successfully.'); window.location.href='pending-orders.php';</script>";
        } else {
            echo "<script>alert('Failed to update order status.'); window.location.href='pending-orders.php';</script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Invalid order ID or status.'); window.location.href='pending-orders.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request method.'); window.location.href='pending-orders.php';</script>";
}

mysqli_close($conn);
?>
