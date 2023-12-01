<?php


//Step 1: Check if a post method was recieved
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //Step 2: get all the data from the form
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];


        //Step 3: try catch + require files
        try{
            require_once '../config.php';
            require_once 'signup_model.php';
            require_once 'signup_contr.php';

            //Step 4: Error handlers
            $errors = [];

            if(is_input_empty($first_name,$last_name,$username,$password,$email,$confirm_password)){
                $errors['empty_input'] = 'Please enter all required fields.';
            }
            else if(!is_email_valid($email))
            {
                $errors['invalid_email'] = 'Please enter an email address';
            }
            else if(!passwords_match($password,$confirm_password))
            {
                $errors['password_match'] = 'Passwords do not match';
            }
            else if(is_username_taken($username)){
                $errors['username_taken'] = 'Username is taken';
            }
            else if(is_email_registered($email)){
                $errors['email_taken'] = 'Email is taken';
            }

            require_once '../config_session.php';

            if(empty($errors))
            {
                $_SESSION['error_signup'] = $errors;

                $user_data = [
                    'username' => $username,
                    'password' => "",
                    'confirm_password' => "",
                    'email' => $email,
                    'first_name' => $first_name,
                    'last_name' => $last_name
                ];

                $_SESSION['user_signup_data'] = $user_data;
                header('Location: ./signup.php');
                die();
            }

            set_user($first_name,$last_name,$username,$password,$email);

            header('Location: ./login.php?signup=success');
            $stmt = null;

            die();

        } catch(mysqli_sql_exception $e)
        {
            die('Signup Failed: ' . $e->getMessage());
        }

    }
    else{
        header("Location: ./signup.php");
        die();
    }
?>