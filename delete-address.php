<?php
session_start();

// Check if the user is logged in
if(empty($_SESSION['loggedUser'])) {
    header('Location: Log-in-Form.php');
    exit;
}

// Include the database connection file
require 'db_connection.php';

// Check if the address ID is provided in the request
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize the input
    $addressID = mysqli_real_escape_string($conn, $_GET['id']);

    // Prepare a delete statement
    $query = "DELETE FROM users_delivery_address WHERE address_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "i", $addressID);

        // Attempt to execute the statement
        if(mysqli_stmt_execute($stmt)) {
            // Address deleted successfully, set a session variable for notification
            $_SESSION['deleteSuccess'] = true;
        } else {
            // Error occurred while deleting the address
            $_SESSION['deleteSuccess'] = false;
            $_SESSION['deleteError'] = "Error: " . mysqli_error($conn);
        }
    } else {
        // Error occurred while preparing the statement
        $_SESSION['deleteSuccess'] = false;
        $_SESSION['deleteError'] = "Error: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);

// Redirect back to myAccount.php
header('Location: myAccount.php');
exit;
?>
