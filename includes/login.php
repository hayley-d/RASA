<?php
require_once '../config.php';
require_once 'login_view.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Playfair+Display:wght@500&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;1,200&display=swap" rel="stylesheet">
    <link rel = "stylesheet" href = "../css/login.css">
</head>
<body>
<div class = "header">
    <div><button class = "back-btn" ><a href="../Cars.php">Back</a></button></div>
    <div><button class = "back-btn" id = "create-btn"><a href="signup.php">Create an Account</a></button></div>
</div>

<div class="login-box">
    <h2>Login</h2>
    <form id = 'loginForm' action = 'validate-login.php' method = 'POST'>
        <div class="user-box">
            <input type="text" name="username" required="">
            <label>Username</label>
        </div>
        <div class="user-box">
            <input type="password" name="password" required="">
            <label>Password</label>
        </div>
        <a onclick="checkInput()">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Submit
        </a>
    </form>
    <script>
        function checkInput()
        {
            document.getElementById('loginForm').submit();
        }
    </script>
</div>

</body>
</html>

<?php
check_login_errors();
?>

