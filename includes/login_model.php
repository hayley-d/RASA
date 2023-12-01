<?php
    declare(strict_types=1); //lets you require a specific data type

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


?>
