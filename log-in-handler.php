<?php 
// Start the session
session_start();

// Database connection parameters
$servername = "localhost";
$db_username = "root";
$db_password = "";
$database = "dimefootwear";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST["user"];
    $password = $_POST["password"];

    // Prepare SQL statement to retrieve user record
    $sql_user = "SELECT * FROM site_user WHERE username = ? AND password = ?";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bind_param("ss", $username, $password);

    // Execute the query for user
    $stmt_user->execute();

    // Store the result for user
    $result_user = $stmt_user->get_result();

    // Check if a matching record is found for user
    if ($result_user->num_rows == 1) {
        // Fetch the user record
        $user = $result_user->fetch_assoc();

        // Store user data in session
        $_SESSION['userID'] = $user['id'];
        $_SESSION['loggedUser'] = $user['username'];
        $_SESSION['email'] = $user['email'];

        // Check if the user is verified
        if ($user['verified'] == 1) {
            // Authentication successful and user is verified, redirect to index.php
            header("Location: index.php");
            exit;
        } else {
            // User is not verified, redirect to otp_log_in.php
            header("Location: otp_log_in.php");
            exit;
        }
    } else {
        // User not found, check in admin_user table
        $sql_admin = "SELECT * FROM admin_user WHERE username = ? AND password = ?";
        $stmt_admin = $conn->prepare($sql_admin);
        $stmt_admin->bind_param("ss", $username, $password);

        // Execute the query for admin
        $stmt_admin->execute();

        // Store the result for admin
        $result_admin = $stmt_admin->get_result();

        if ($result_admin->num_rows == 1) {
            // Admin authentication successful, redirect to dashboard.php
            $admin = $result_admin->fetch_assoc();
            $_SESSION['admin_user'] = $admin['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            // Authentication failed, display error message
            echo "Invalid username or password. Please try again.";
        }
    }

    // Close the statements
    $stmt_user->close();
    $stmt_admin->close();
}

// Close the database connection
$conn->close();
?>
