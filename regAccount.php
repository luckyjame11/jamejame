<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - DIME FOOTWEAR</title>
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
            top: calc(48% - 320px);
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
/*            margin-top: 10px;*/
            color: #fff;
        }

        .login input[type="text"],
        .login input[type="password"],
        .login input[type="email"],
        .login input[type="submit"] {
            width: 90%;
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
            margin-top: 20px;
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
    <form id="registration-form" action="regAccount-handler.php" method="POST">
        <center>
            <h1 class="log-in">Register Here!</h1>
            <hr class="solid">
            <label for="user">Username:</label>
            <input type="text" id="user" name="user" placeholder="username" required onblur="checkUsernameAvailability()"><br>
            <p id="username-feedback" style="margin-top: 0px;margin-bottom: 0px;" ></p> <!-- Feedback for username -->
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="password" required style="margin-bottom: 0px;"><br>
            <div>
            <input type="checkbox" onclick="togglePasswordVisibility()" style="float: left;margin-top: 0px;"><p align="left" >Show Password<p/>
            </div>
            <label for="fullname">Fullname:</label>
            <input type="text" id="fullname" name="fullname" placeholder="eg. Juan Dela Cruz" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="eg. juan.delacruz@gmail.com" required onblur="checkEmailAvailability()"><br>
            <p id="email-feedback" style="margin-top: 0px;margin-bottom: 0px;" ></p> <!-- Feedback for email -->
            <label for="contactNum">Contact Number:</label>
            <input type="text" id="contactNum" name="contactNum" placeholder="eg. 09312345678" required><br>
            <input type="submit" value="Create a New Account" name="Login" style="width:100%;">
            <a href="Log-in-Form.php" class="forgot">Already have an Account?</a>
        </center>
    </form>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
function checkUsernameAvailability() {
    var username = document.getElementById('user').value;
    // Check if username is not empty
    if (username.trim() !== '') {
        $.ajax({
            type: 'POST',
            url: 'checkUsername.php',
            data: {username: username},
            success: function(response) {
                $('#username-feedback').html(response);
            }
        });
    } else {
        // Clear the feedback if username is empty
        $('#username-feedback').html('');
    }
}

function checkEmailAvailability() {
    var email = document.getElementById('email').value;
    // Check if email is not empty
    if (email.trim() !== '') {
        $.ajax({
            type: 'POST',
            url: 'checkEmail.php',
            data: {email: email},
            success: function(response) {
                $('#email-feedback').html(response);
            }
        });
    } else {
        // Clear the feedback if email is empty
        $('#email-feedback').html('');
    }
}


</script>
</body>
</html>
