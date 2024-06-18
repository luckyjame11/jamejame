<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dime Footwear | Login</title>
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap-theme.css" rel="stylesheet" />

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
   <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="log_in2.css">
    <style type="text/css">
        /* Center the login form vertically and horizontally */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .login {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
    <script type="text/javascript">
        // This script needs correction
        var create = getElementByIdName('create');
    </script>
</head>
<body>
    <div class="body"></div>
        
    <div class="login">
        <form action="check_otp" method="POST">
            <center>
                <h1 class="log-in">Enter OTP</h1>
                <br>
                <p>Check Your Email</p>
                <hr class="solid">
                <input type="text" placeholder="Username" name="user">
                <br>
                <br>
                <input type="button" name="create" value="Submit">
                <!-- <a href="" class="newUser">Create a New Account</a> -->
                <br>
                <a href="" class="forgot">Already Have An Account?</a>
            </center>
        </form>
    </div>
</body>
</html>
