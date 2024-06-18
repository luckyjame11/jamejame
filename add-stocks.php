<?php
// Include your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dimefootwear";

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Retrieve stock details from the form
        $serial_id = $_POST['productNumber'];
        $size_7 = $_POST['size-7'];
        $size_7_5 = $_POST['size-7-5'];
        $size_8 = $_POST['size-8'];
        $size_8_5 = $_POST['size-8-5'];
        $size_9 = $_POST['size-9'];
        $size_9_5 = $_POST['size-9-5'];
        $size_10 = $_POST['size-10'];
        $size_10_5 = $_POST['size-10-5'];
        $size_11 = $_POST['size-11'];
        $size_11_5 = $_POST['size-11-5'];

        // Prepare the SQL statement for each size to add quantities
        $update_sql = "UPDATE shoe_stocks 
                       SET quantity = quantity +
                       CASE size
                           WHEN 7 THEN ?
                           WHEN 7.5 THEN ?
                           WHEN 8 THEN ?
                           WHEN 8.5 THEN ?
                           WHEN 9 THEN ?
                           WHEN 9.5 THEN ?
                           WHEN 10 THEN ?
                           WHEN 10.5 THEN ?
                           WHEN 11 THEN ?
                           WHEN 11.5 THEN ?
                           ELSE 0
                       END
                       WHERE serial_id = ?";

        // Prepare the SQL statement
        $stmt = $pdo->prepare($update_sql);        

        // Execute the SQL statement for each size
        $stmt->execute([$size_7, $size_7_5, $size_8, $size_8_5, $size_9, $size_9_5, $size_10, $size_10_5, $size_11, $size_11_5, $serial_id]);

        // Check if any rows were affected
        if ($stmt->rowCount() > 0) {
             echo "<script>
                    alert('Stocks added successfully.');
                    window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
                  </script>";
            exit();
        } else {
            echo "No records updated. Serial ID not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
