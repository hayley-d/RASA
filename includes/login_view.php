<?php
    declare(strict_types=1); //lets you require a specific data type
    function check_login_errors() {
        if(isset($_SESSION['errors_login'])){
            $errors = $_SESSION['errors_login'];

            unset($_SESSION['errors_login']);//clean
            echo '<br>';

            foreach ($errors as $error){
                echo '<p>'.$error.'</p>';
            }
        }
        else if(isset($_GET['login']) && $_GET['login'] === 'success'){
            //login success

        }
    }

    function output_username()
    {
        if(isset($_SESSION['user_id'])){
            echo 'You are logged in as '. $_SESSION['username'];
        }
        else{
            echo 'You are not logged in';
        }
    }
