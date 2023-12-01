<?php
class DatabaseSingleton {
    private static $instance;
    private $connection;

    private function __construct() {
        // Private constructor to prevent instantiation
        $db_host = 'localhost';
        $db_user = 'root';
        $db_password = '';
        $db_name = 'cars';

        // Create a new MySQLi connection
        $this->connection = new mysqli($db_host, $db_user, $db_password, $db_name);

        // Check the connection
        if ($this->connection->connect_error) {
            die('Connection failed: ' . $this->connection->connect_error);
        }

        // Set MySQLi attributes
        $this->connection->set_charset('utf8');
    }

    //checks if an instance of the class existis already and if not creates a new instance.
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance->connection;
    }


}
global $db;
$db = DatabaseSingleton::getInstance();
    // To use the singleton instance
   // $db = DatabaseSingleton::getInstance();
    // $db is now the MySQLi connection instance

//designed to implement the singleton pattern
//the static property instance holds the singleton isntance to store the conntection.

?>

<?php
//$_COOKIE - stores information on the browser (for light mode/cart) (easier to hack) has a time limit
//$_SESSION - stores information on the server side (for log in) (for valuable information) ends when the browser closes
global $username;
global $password;

setcookie("lightMode","dark", time() + (30*86400));//cookie lasts for a month has the name of lightmode and value of dark

//sessions for login
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;


// Function to generate an alphanumeric API key of a specified length



?>

