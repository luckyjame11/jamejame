<?php
if (isset($_POST['verify'])) {
    // Retrieve form data
    $email = $_POST['email'];
    $otp = $_POST['otp'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dimefootwear";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the OTP matches
    $sql = "SELECT otp FROM site_user WHERE email = ? AND otp = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $otp);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // OTP matches, update verified field
        $update_sql = "UPDATE site_user SET verified = 1 WHERE email = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("s", $email);
        if ($update_stmt->execute()) {
            echo "Email verification successful!";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Invalid OTP. Please try again.";
    }

    $stmt->close();
    $conn->close();
}
?>
