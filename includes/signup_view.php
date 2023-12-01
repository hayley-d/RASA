<?php
declare(strict_types=1);

function check_signup_errors()
{
    if(isset($_SESSION['errors_signup']))
    {
        $errors = $_SESSION['errors_signup'];

        foreach ($errors as $error){
            echo '<p>'.$error.'</p>';
        }
        unset($_SESSION['errors_signup']);
    }
    else if(isset($_GET['signup']) && $_GET['signup'] === 'success'){

    }
}

function signup_input(){
    if(isset($_SESSION['user_signup_data']['username']) && isset($_SESSION['username_taken']))
    {
        //username was taken
        //do not repopulate the username input
        echo '<div class="user-box">
            <input type="text" name="first_name" required="" value = "'.$_SESSION['user_signup_data']['first_name'].'">
            <label>Name</label>
        </div>
        <div class="user-box">
            <input type="text" name="last_name" required="" value = "'.$_SESSION['user_signup_data']['last_name'].'">
            <label>Surname</label>
        </div>
        <div class="user-box">
            <input type="email" name="email" required="" value = "'.$_SESSION['user_signup_data']['email'].'">
            <label>Email</label>
        </div>
        <div class="user-box">
            <input type="text" name="username" required="" value = "">
            <label>Username</label>
        </div>
        <div class="user-box">
            <input type="password" name="password" required="" value = "">
            <label>Password</label>
        </div>
        <div class="user-box">
            <input type="password" name="confirm_password" required="" value = "">
            <label>Confirm Password</label>
        </div>';
    }
    if(isset($_SESSION['user_signup_data']['email']) && isset($_SESSION['email_taken']))
    {
        //email was taken
        //do not repopulate email field
        echo '<div class="user-box">
            <input type="text" name="first_name" required="" value = "'.$_SESSION['user_signup_data']['first_name'].'">
            <label>Name</label>
        </div>
        <div class="user-box">
            <input type="text" name="last_name" required="" value = "'.$_SESSION['user_signup_data']['last_name'].'">
            <label>Surname</label>
        </div>
        <div class="user-box">
            <input type="email" name="email" required="" value = "">
            <label>Email</label>
        </div>
        <div class="user-box">
            <input type="text" name="username" required="" value = "'.$_SESSION['user_signup_data']['username'].'">
            <label>Username</label>
        </div>
        <div class="user-box">
            <input type="password" name="password" required="" value = "">
            <label>Password</label>
        </div>
        <div class="user-box">
            <input type="password" name="confirm_password" required="" value = "">
            <label>Confirm Password</label>
        </div>';
    }
    else if(isset($_SESSION['user_signup_data'])){
        echo '<div class="user-box">
            <input type="text" name="first_name" required="" value = "'.$_SESSION['user_signup_data']['first_name'].'">
            <label>Name</label>
        </div>
        <div class="user-box">
            <input type="text" name="last_name" required="" value = "'.$_SESSION['user_signup_data']['last_name'].'">
            <label>Surname</label>
        </div>
        <div class="user-box">
            <input type="email" name="email" required="" value = "'.$_SESSION['user_signup_data']['email'].'">
            <label>Email</label>
        </div>
        <div class="user-box">
            <input type="text" name="username" required="" value = "'.$_SESSION['user_signup_data']['username'].'">
            <label>Username</label>
        </div>
        <div class="user-box">
            <input type="password" name="password" required="" value = "">
            <label>Password</label>
        </div>
        <div class="user-box">
            <input type="password" name="confirm_password" required="" value = "">
            <label>Confirm Password</label>
        </div>';
    }
    else{
        echo '<div class="user-box">
            <input type="text" name="first_name" required="">
            <label>Name</label>
        </div>
        <div class="user-box">
            <input type="text" name="last_name" required="">
            <label>Surname</label>
        </div>
        <div class="user-box">
            <input type="email" name="email" required="">
            <label>Email</label>
        </div>
        <div class="user-box">
            <input type="text" name="username" required="">
            <label>Username</label>
        </div>
        <div class="user-box">
            <input type="password" name="password" required="">
            <label>Password</label>
        </div>
        <div class="user-box">
            <input type="password" name="confirm_password" required="">
            <label>Confirm Password</label>
        </div>';
    }
}

?>