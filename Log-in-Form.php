<?php
// 

if (!empty($_SESSION['loggedUser'])) {
    header('Location: index.php');
    exit;
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "dimefootwear";
$error_message_Log_in = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST["user"];
    $password = $_POST["password"];

    // Prepare SQL statement to retrieve admin user record
    $sqlAdmin = "SELECT * FROM admin_user WHERE username = ? AND password = ?";
    $stmtAdmin = $conn->prepare($sqlAdmin);
    $stmtAdmin->bind_param("ss", $username, $password);

    // Execute the admin query
    $stmtAdmin->execute();

    // Store the result
    $resultAdmin = $stmtAdmin->get_result();

    // Check if a matching admin record is found
    if ($resultAdmin->num_rows == 1) {
        // Fetch the admin user record
        $userAdmin = $resultAdmin->fetch_assoc();

        // Store admin user data in session
        $_SESSION['loggedUserAdmin'] = $userAdmin['username'];
        $_SESSION['adminID'] = $userAdmin['admin_id'];

        // Redirect to admin panel
        header("Location: dashboard.php");
        exit;
    } else {
        // If admin authentication fails, check site user
        // Prepare SQL statement to retrieve site user record
        $sqlSiteUser = "SELECT * FROM site_user WHERE username = ? AND password = ?";
        $stmtSiteUser = $conn->prepare($sqlSiteUser);
        $stmtSiteUser->bind_param("ss", $username, $password);

        // Execute the site user query
        $stmtSiteUser->execute();

        // Store the result
        $resultSiteUser = $stmtSiteUser->get_result();

        // Check if a matching site user record is found
        if ($resultSiteUser->num_rows == 1) {
            // Fetch the site user record
            $userSite = $resultSiteUser->fetch_assoc();

            // Store site user data in session
            $_SESSION['loggedUser'] = $userSite['username'];
            $_SESSION['userID'] = $userSite['id'];
            $_SESSION['fullname'] = $userSite['full_name'];
            $_SESSION['email'] = $userSite['email'];

            // Check if the user is verified
            if ($userSite['verified'] == 1) {
                // Authentication successful and user is verified, redirect to index.php
                header("Location: index.php");
                exit;
            } else {
                // User is not verified, redirect to otp_log_in.php
                header("Location: otp_log_in.php");
                exit;
            }
        } else {
            // Authentication failed, display error message
            $error_message_Log_in = "Incorrect Username & Password!";
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log In - DIME FOOTWEAR</title>
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap-theme.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="regAcc.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="regAcc.css">
    <style type="text/css">
        body {
            background-image: url('img/bg.jpeg');
            background-size: cover;
            background-repeat: no-repeat; 
          
        }
        .login input[type="email"] {
            width: 200px; /* Reduce width of email input */
            height: 30px;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 2px;
            color: #fff;
            font-family: 'Exo', sans-serif;
            font-size: 16px;
            font-weight: 400;
            padding: 4px;
            margin-bottom: 20px;
        }

        .login input[type="email"]:focus {
            outline: none;
            background: white;
            color: black;
            border: 1px solid rgba(255, 255, 255, 0.9);
        }

        .login {
            position: absolute;
            top: calc(48% - 200px);
            left: calc(58% - 50px);
            padding-top: 10px;
            padding-bottom: 20px;
            padding-left: 35px;
            padding-right: 35px;
            background-color: #282A35;
            z-index: 2;
            box-shadow: 2px 2px 10px #000000;
            border-radius: 7px;
            width: 400px; /* Reduce width of form container */
        }

        .header {
            position: absolute;
            top: calc(50% - 150px);
            left: calc(55% - 500px);
            z-index: 2;
        }

        /* Additional CSS for the form */
        .login form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .login label {
            width: 100%;
            text-align: left;
            margin-top: 10px;
            color: #fff;
        }

        .login input[type="text"],
        .login input[type="password"],
        .login input[type="email"],
        .login input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 4px;
            color: #fff;
            font-family: 'Exo', sans-serif;
            font-size: 16px;
        }

        .login input[type="text"]:focus,
        .login input[type="password"]:focus,
        .login input[type="email"]:focus {
            outline: none;
            background: white;
            color: black;
            border: 1px solid rgba(255, 255, 255, 0.9);
        }

        .login input[type="submit"] {
            
            background-color: #ffcc00;
            color: black;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }

        .login input[type="submit"]:hover {
            background-color: #ff9900;
        }

        .login .forgot {
            margin-top: 10px;
            color: #ffcc00;
            text-decoration: none;
        }

        .login .forgot:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>


<div class="header">
    <div>DIME<span><br>FOOTWEAR</span></div>
</div>
<br>
<div class="login">
    <form action="<?=($_SERVER['PHP_SELF'])?>" method="POST">
        <center>
            <h1 class="log-in">Log In Here!</h1>
            <hr class="solid">
            <span style="color: red;"><?= $error_message_Log_in ?></span>
            <label for="user">Username:</label>
            <input type="text" id="user" name="user" placeholder="username" required style=""><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="password" required style=""><br>
            <input type="checkbox" onclick="togglePasswordVisibility()" style="float: left;"><p style="float: left;margin-top: 3px;" style="width:85%;">Show Password</p>
            <input type="submit" value="Log In" name="Login">
            <a href="regAccount.php" class="forgot">Don't have an Account?</a>
        </center>
    </form>
</div>

<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
</script>
</body>
</html>
