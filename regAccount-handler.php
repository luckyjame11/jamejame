<?php
require 'phpmailer/vendor/phpmailer/phpmailer/src/Exception.php';
require 'phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Start PHP session
session_start();

if (isset($_POST['Login'])) { 
    // Retrieve form data
    $username1 = isset($_POST['user']) ? $_POST['user'] : '';
    $password2 = isset($_POST['password']) ? $_POST['password'] : '';
    $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
    $contactNum = isset($_POST['ContactNum']) ? $_POST['ContactNum'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Generate a 6-digit OTP
    $otp = rand(100000, 999999);

    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit; // Stop execution if email is invalid
    }

     // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dimefootwear";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Insert user data along with the OTP
    $sql = "INSERT INTO site_user (username, password, full_name, contact_num, email, otp) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $username1, $password2, $fullname, $contactNum, $email, $otp);

       if ($stmt->execute()) {
       $mail = new PHPMailer(true);
try {
    //Server settings
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

    //Recipients
    $mail->setFrom('lj_budlao@outlook.com', 'Dime Footwear');
    $mail->addAddress($email);     

    // Content
    $mail->isHTML(true);                                  
    $mail->Subject = 'Your OTP for Dime Footwear Registration';
    $mail->Body    = 'Hello '.$fullname.', your OTP for email verification is: ' . $otp;

    $mail->send();

    // Store OTP and user email in session
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;

    // Redirect to OTP verification page
    header('Location: otp.php');
    exit();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    // Log error for debugging
    error_log("Error sending email: " . $e->getMessage(), 0);
}
}

    $stmt->close();
    $conn->close();
}
?>
