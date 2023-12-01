<?php
//Step 1: check for a request method
if($_SERVER["REQUEST_METHOD"] === "POST")
{
    //get the data from the form inputs
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Step 3: add try catch
    try{
        //Step 4: create the controller, model and view files
        //Step 6: require the database connection
        require_once '../config.php';

        //Step 5: include the created files
        require_once 'login_model.php';
        require_once 'login_contr.php';

        //Step 7: Add error handelers
        $errors = []; //empty array for the errors caught

        if(is_input_empty($username,$password)){
            $errors['empty_input'] = "Fill on all fields";
        }

        $result = get_user($username);

        if(!is_username_valid($result))
        {
            $errors['wrong_username'] = "Username is incorrect";
        }

        if(is_username_valid($result))
        {
            if(!is_password_valid($password,$result['password']))
            {
                $errors['wrong_password'] = "Password is incorrect";
            }
        }


        //step 12: handel the errors
        require_once '../config_session.php';

        if($errors){
            $_SESSION['errors_login'] = $errors;

            header("location: ./login.php");
            die();
        }

        $newSessionId = session_create_id();//creates a new id with the users api key
        $sessionId = $newSessionId . '_' . $result['apikey'];
        session_id($sessionId); //sets the session id to the created session id

        $_SESSION['user_id'] = $result['apikey'];
        $_SESSION['username'] = htmlspecialchars($result['username']);//sanitize result avoid any cross side scripting
        $_SESSION['password'] = $result['password'];

        $_SESSION['last_regeneration'] = time();

        header('location: ../Cars.php');

        $stmt = null;//close statement
        die();

    } catch(mysqli_sql_exception $e){
        die("Login Failed: " . $e->getMessage());
    }
}
else{
    //if no post method was recieved
    header("Location: Cars.php?login=success");
    die();
}
?>