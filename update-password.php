<?php
session_start();
if(isset($_SESSION['userID'])){
    $userID = $_SESSION['userID'];

    require 'db_connection.php'; // Check if this file exists and is correctly configured

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Assuming you have sanitized and validated the input data
        $newFullname = $_POST['fullname'];
        $newContact = $_POST['contact'];
        $newPassword = $_POST['password']; // Hash the new password

        // Prepare and execute the UPDATE query
        $query = "UPDATE site_user SET full_name=?, contact_num=?, password=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        if($stmt){
            mysqli_stmt_bind_param($stmt, "sssi", $newFullname, $newContact, $newPassword, $userID);
            mysqli_stmt_execute($stmt);

            // Check if the query was successful
            if(mysqli_stmt_affected_rows($stmt) > 0) {
                // Alert for successful update
                echo '<script>alert("User information updated successfully."); window.location.href = "myAccount.php";</script>';
            } else {
                // Alert for failed update
                echo '<script>alert("Failed to update user information."); window.location.href = "myAccount.php";</script>';
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement.";
        }
    }
} else {
    echo "User ID not set in session.";
}
?>
