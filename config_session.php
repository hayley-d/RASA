<?php
    ini_set('session.use_only_cookies',1);
    ini_set('session.use_strict_mode',1);

    session_set_cookie_params([
        'lifetime' => 1800,
        'domain' => 'localhost',
        'path' => '/',
        'secure' => true,
        'httponly' => true
    ]);

    session_start();

    if(isset($_SESSION['user_id'])){
        if(!isset($_SESSION['last_regeneration'])){
            regenerate_session_id_loggedin();
        }
        else{
            $interval = 60*30;
            if(time() - $_SESSION['last_regeneration'] >= $interval)
            {
                regenerate_session_id_loggedin();
            }
        }
    }
    else{
        //user not logged in
        if(!isset($_SESSION['last_regeneration'])){
            regenerate_session_id();
        }
        else{
            $interval = 60*30;
            if(time() - $_SESSION['last_regeneration'] >= $interval)
            {
                regenerate_session_id();
            }
        }
    }



    function regenerate_session_id() :void
    {
        session_regenerate_id(true);//regenerates the session id
        $_SESSION['last_regeneration'] = time();
    }

function regenerate_session_id_loggedin() :void
{
    session_regenerate_id(true);//regenerates the session id

    $userId = $_SESSION['user_id'];
    $newSessionId = session_create_id();//creates a new id with the users api key
    $sessionId = $newSessionId . '_' . $userId;
    session_id($sessionId); //sets the session id to the created session id

    $_SESSION['last_regeneration'] = time();
}
?>