<?php

    require_once '../config_session.php';
    require_once 'signup_view.php';
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
    <link rel = "stylesheet" href = "../css/signup.css">
</head>
<body>
<div class = "header">
    <div><button class = "back-btn" ><a href="../Cars.php">Back</a></button></div>
    <div><button class = "back-btn" id = "create-btn"><a href="login.php">Login</a></button></div>
</div>

<div class="signUp-box">
    <h2>Create Account</h2>
    <form id = "signup-form" action = 'validate-signup.php' method = 'POST'>
        <?php signup_input(); ?>
        <a onclick="validateInformation()">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Submit
        </a>
    </form>
    <script>
        function validateInformation()
        {
            document.getElementById('signup-form').submit();
        }
    </script>
</div>

</body>
</html>

<?php
/*check_signup_errors();
*/?>