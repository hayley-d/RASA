<?php
declare(strict_types=1);

//handels user input

function is_input_empty( string $first_name,string $last_name,string $username,string $password,string $email,string $confirm_password):bool
{
    if( empty($first_name) || empty($last_name) || empty($username) || empty($password) || empty($email) || empty($confirm_password))
    {
        return true;
    }
    else{
        return false;
    }
}

function is_email_valid(string $email):bool
{
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        return true;
    }
    else{
        return false;
    }
}

function passwords_match(string $password,string $confirm_password): bool
{
    if($password === $confirm_password)
    {
        return true;
    }
    else{
        return false;
    }
}

function is_username_taken(string $username):bool {
    if(get_user($username) !== null)
    {
        return true;
    }
    else {
        return false;
    }
}

function is_email_registered($email)
{
    if(get_email($email) !== null)
    {
        return true;
    }
    else {
        return false;
    }
}

function set_user($first_name,$last_name,$username,$password,$email):void
{
    create_user($first_name,$last_name,$username,$password,$email);
}

function generateApiKey() {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $apiKey = '';

    for ($i = 0; $i < 16; $i++) {
        $apiKey .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $apiKey;
}

function argon2i($password): string
{
    $salt = bin2hex(random_bytes(16)); // generate a random 16-byte salt
    $hash_options = [
        'memory_cost' => 1024, // memory cost parameter
        'time_cost' => 2, // time cost parameter
        'threads' => 2 // number of threads to use
    ];

    // Hash the password with Argon2i
    $hashed_password = password_hash($password . $salt, PASSWORD_ARGON2I, $hash_options);

    // Return the hashed password and the salt
    return $hashed_password . '|' . $salt;
}


?>