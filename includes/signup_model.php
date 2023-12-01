<?php
//only database queries and communicating with the datatbase
declare(strict_types=1);

require_once '../config.php';

function get_user(string $username_given)
{
    global $db;
    $query = "SELECT * FROM users WHERE username = ?";

    try {
        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $username_given); // 's' indicates a string parameter
        $stmt->execute();

        // Bind the result variable
        $stmt->bind_result($apikey,$username,$password,$first_name,$last_name,$email);

        // Fetch the user data
        $stmt->fetch();

        // Return the user data
        return [
            'apikey' => $apikey,
            'username' => $username,
            'password' => $password,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email
        ];
    } catch (Exception $e) {
        // Handle the exception (log, display an error, etc.)
        echo "Error: " . $e->getMessage();
        return null;
    }
}

function create_user($first_name,$last_name,$username,$password,$email):void
{
    global $db;
    $apikey = generateApiKey();
    $hashed_password = argon2i($password);

    $query = "INSERT INTO users (apikey,username,password,first_name,last_name,email) VALUES (?,?,?,?,?,?);";

    try {
        $stmt = $db->prepare($query);
        $stmt->bind_param("ssssss", $apikey,$username,$hashed_password,$first_name,$last_name,$email); // 's' indicates a string parameter
        $stmt->execute();

    } catch (Exception $e) {
        // Handle the exception (log, display an error, etc.)
        echo "Error: " . $e->getMessage();
        header('Location: ../Cars.php');
        die();
    }
}

function get_email(string $email_given)
{
    global $db;
    $query = "SELECT * FROM users WHERE email = ?";

    try {
        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $email_given); // 's' indicates a string parameter
        $stmt->execute();

        // Bind the result variable
        $stmt->bind_result($apikey,$username,$password,$first_name,$last_name,$email);

        // Fetch the user data
        $stmt->fetch();

        // Return the user data
        return [
            'apikey' => $apikey,
            'username' => $username,
            'password' => $password,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email
        ];
    } catch (Exception $e) {
        // Handle the exception (log, display an error, etc.)
        echo "Error: " . $e->getMessage();
        return null;
    }
}
?>