<?php
session_start();

$user = $_SESSION['loggedUser'];

$_SESSION['email'];
$email = $_SESSION['email'];
$successMessage = '';
$failedMessage = ''; // Define $failedMessage variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form is submitted
    if (isset($_POST['verify'])) {
        // Retrieve form data
        $otp = $_POST['user'];

        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dimefootwear";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check OTP from the database
        $sql = "SELECT * FROM site_user WHERE username = '$user' AND otp = '$otp'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // OTP is correct, update 'verified' field to 1
            $updateSql = "UPDATE site_user SET verified = 1 WHERE username = '$user' AND otp = '$otp'";
            if ($conn->query($updateSql) === TRUE) {
                // Set success message
                $successMessage = "Verification successful!";
                // Redirect to Log-in-Form.php after 2 seconds
                echo "<script>
                        setTimeout(function(){
                            window.location.href = 'index.php';
                        }, 2000);
                    </script>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            // Invalid OTP, display an error message
            $failedMessage = "Wrong OTP!";
        }

        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - DIME FOOTWEAR</title>
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap-theme.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="otp.css">
    <link rel="stylesheet" type="text/css" href="log_in2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="login">
    <form action="" method="POST">
        <h1 class="log-in">Enter OTP</h1>
        <hr class="solid" style="border-top: 1px solid #fff;">
        <p>Check Your Email</p>
        <input type="text" id="user" name="user" placeholder="Enter your OTP" maxlength="6" required>
        <input type="submit" name="verify" value="Verify">
        <a href="Log-in-Form.php" class="forgot">Already have an Account?</a>
    </form>
    
    <!-- Add Re-send OTP button outside the verification form -->
    <form action="reSendCode.php" method="POST">
        <button type="submit" name="resend">Re-send OTP</button>
    </form>
</div>



<!-- Success Modal -->
<div id="successModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <p class="modal-message"><?php echo $successMessage; ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Failed Modal -->
<div id="failedModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <p class="modal-message"><?php echo $failedMessage; ?></p>
            </div>
        </div>
    </div>
</div>

<?php
// Display the success modal if the verification was successful
if (!empty($successMessage)) {
    echo "<script>$('#successModal').modal('show');</script>";
}
// Display the failed modal if the verification failed
if (!empty($failedMessage)) {
    echo "<script>$('#failedModal').modal('show');</script>";
}
?>

</body>
</html>
