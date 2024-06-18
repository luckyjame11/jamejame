<?php
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Start PHP session
session_start();
$_SESSION['email'];
$email = $_SESSION['email'];
$email = filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the "resend" button is clicked
    if (isset($_POST['resend'])) {
        // Generate a new OTP
        $newOTP = rand(100000, 999999);

        // Retrieve the logged-in user from the session or from the form data
        $user = $_SESSION['loggedUser']; // Adjust this according to your session data
        $fullname = $_SESSION['fullname'];
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dimefootwear";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Update the OTP in the database
        $updateSql = "UPDATE site_user SET otp = '$newOTP' WHERE username = '$user'";
        if ($conn->query($updateSql) === TRUE) {
            // Send the new OTP to the user's email address
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->SMTPDebug = 0;
                $mail->isSMTP();                                            
                $mail->Host       = 'smtp.office365.com';                       
                $mail->SMTPAuth   = true;                                   
                $mail->Username   = 'lj_budlao@outlook.com';            
                $mail->Password   = 'luckyjame2023';                  
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
                $mail->Port       = 587;                                   
                
                // Disable SSL certificate verification
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                
                // Recipients
                $mail->setFrom('lj_budlao@outlook.com', 'Dime Footwear');
                $mail->addAddress($email); // Use $user instead of $email
                
                // Content
                $mail->isHTML(true);                                  
                $mail->Subject = 'Your OTP for Dime Footwear Registration';
                $mail->Body    = 'Hello '.$fullname.', your new OTP for email verification is: ' . $newOTP; // Use $user instead of $email
                
                $mail->send();
                
                // Store the new OTP in the session
                $_SESSION['otp'] = $newOTP;
                
                // Redirect to OTP verification page
                header('Location: otp_log_in.php');
                exit();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                // Log error for debugging
                error_log("Error sending email: " . $e->getMessage(), 0);
            }
        } else {
            echo "Error updating OTP: " . $conn->error;
        }
        
        $conn->close();
    }
}
?>
