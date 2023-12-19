<?php
require_once './config.php';

//get the post data
$json = file_get_contents('php://input');
// Converts it into a PHP object
$requestData = json_decode($json,true);

class api2
{
    private const DEFAULT_IMAGE = 'https://wheatley.cs.up.ac.za/api/images/models/ac_aceca.jpg';

    // API endpoint URL
    private const APIURL = 'https://wheatley.cs.up.ac.za/api/getimage';

    public function verifyUser($apikey):bool
    {
        global $db;

        $query = "SELECT apikey FROM users WHERE apikey = ?";

        try {
            $stmt = $db->prepare($query);
            $stmt->bind_param("s", $apikey);
            $stmt->execute();

            // Bind the result variable
            $stmt->bind_result($resultApiKey);

            // Fetch the user data
            $stmt->fetch();

            // Return the user data
            return $resultApiKey !== null;

        } catch (Exception $e) {
            // Handle the exception (log, display an error, etc.)
            echo "Error: " . $e->getMessage();
            echo "Error verifying user: GETALLMAKES";
            return false;
        }
    }

    public function getData($requestData){
        global $db;

        // Check if the required keys are present in the request
        $requiredKeys = ['apikey', 'type', 'return'];

        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $requestData)) {
                $this->response(false,"Missing key",[]);
            }
        }

        // Extract data from the request
        $apiKey = $requestData['apikey'];

        $type = $requestData['type'];

        $return = $requestData['return'];


        // Optional keys with default values if not present
        $limit = $requestData['limit'] ?? null;
        $sort = $requestData['sort'] ?? null;
        $order = $requestData['order'] ?? null;
        $search = $requestData['search'] ?? null;
        $fuzzy = $requestData['fuzzy'] ?? false;

        //process data
        if($this->verifyUser($apiKey)){
            //if the user is on the database
            //confirm the type
            if($type === 'GetAllMakes')
            {
                $data = $this->getAllMakes($db);
                if($data !== null)
                {
                    $this->response("success","",$data);
                    return;
                }
                else{
                    $this->response(false,"",$data);
                    return;
                }

            }
            else if($type === 'GetAllCars'){
                //get the data
                $data = $this->getCars($db,$limit,$sort,$order,$search,$fuzzy);
                if($data !== null)
                {
                    $finalData = $this->handelReturn($return,$data);
                    //an associative array
                    $this->response("success","",$finalData);
                }
                else{
                    $this->response("false","",[]);
                    return;
                }
            }
            else{
                $this->response(false,"Wrong request type",[]);
                return;
            }

        }
        else{

            $this->response(false,"Invalid apikey",[]);
        }


    }

    public function response($success, $message = "", $data="")
    {

        echo json_encode([
            "success" => $success,
            "message" => $message,
            "data" => $data
        ]);
    }

    protected function getAllMakes ($db):array|null
    {

        $query = "SELECT make FROM cars ";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute();

            // Fetch all rows
            $makes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            // Return the makes array
            return $makes;
        } catch (Exception $e) {
            // Handle the exception (log, display an error, etc.)
            echo "Error: " . $e->getMessage();
            echo "Error fetching call makes.";
            return null;
        }
    }

    protected function getCars($db,$limit,$sort_field,$sort_order, $search,bool $fuzzy):array|null
    {
        $query = "SELECT * FROM cars ";

        if ($search !== null) {
            // Build WHERE clause for search parameters
            $whereClause = implode(' AND ', array_map(function ($key) use ($fuzzy) {
                return $fuzzy ? "$key LIKE ?" : "$key = ?";
            }, array_keys($search)));

            $query .= " WHERE $whereClause";
        }

        // Add ORDER BY and LIMIT clauses
        if ($sort_field !== null && in_array(strtoupper($sort_order), ['ASC', 'DESC'])) {
            $query .= " ORDER BY $sort_field $sort_order";
        }

        if ($limit !== null && is_numeric($limit)) {
            $query .= " LIMIT $limit";
        }

        try{
            $stmt = $db->prepare($query);

            if (!$stmt) {
                throw new Exception("Error preparing the SQL query.");
            }

            if($search !== null)
            {
                // If using fuzzy search, add wildcard to search values
                if ($fuzzy) {
                    $search = array_map(function ($value) {
                        return "%$value%";
                    }, $search);
                }

                // Bind parameters dynamically
                // Bind parameters dynamically
                $bindTypes = str_repeat('s', count($search));
                $stmt->bind_param($bindTypes, ...array_values($search));
            }

            // Execute the statement
            $executionResult = $stmt->execute();

            if (!$executionResult) {
                throw new Exception("Error executing the SQL query: " . $stmt->error);
            }

            // Get the result set
            $result = $stmt->get_result();

            if (!$result) {
                throw new Exception("Error getting the result set: " . $stmt->error);
            }

            // Fetch all results
            $results = $result->fetch_all(MYSQLI_ASSOC);

            // Return the user data
            return $results;
        }

        catch (Exception $e) {
            // Handle the exception (log, display an error, etc.)
            echo "Error: " . $e->getMessage();
            echo "Error fetching data. Please try again later.";
            return null;
        }
    }

    protected  function handelReturn(string|array $return,array $database_results):array
    {
        $results = [];
        // function filters out any unwanted data
        if (gettype($return) === 'string') {
            foreach ($database_results as $result) {
                // Add 'image' key to the single result
                $image = $this->handleRequest($result['make'], $result['model']);
                $result['image'] = $image;
            }
            return $database_results;
        } else {
            foreach ($database_results as $result) {
                $singleResult = [];

                foreach ($return as $key) {
                    // Check if the key exists in the current result
                    if (array_key_exists($key, $result)) {
                        $singleResult[$key] = $result[$key];
                    } else {
                        // Handle non-existent key (you can log a warning or take other actions)
                        echo "Error invalid key: " . $key;
                    }
                }

                // Add 'image' key to the single result
                if($singleResult['make'] !== null && $singleResult['model'] !== null){
                    $image = $this->handleRequest($singleResult['make'], $singleResult['model']);
                    $singleResult['image'] = $image;
                }
                else{
                    $singleResult['image'] = api2::DEFAULT_IMAGE;
                }
                $results[] = $singleResult;
            }
            return $results;
        }
    }

    protected function getImageUrl($queryParams): string|null {
        // Construct the full URL with query parameters
        $urlWithParams = api2::APIURL . '?' . http_build_query($queryParams);

        // Initialize cURL session
        $ch = curl_init($urlWithParams);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL session and get the result
        $imageUrl = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            // Handle cURL error
            // Log the error or return an appropriate response
            return null;
        }

        // Close cURL session
        curl_close($ch);

        // Check if the response contains a valid image URL
        if (filter_var($imageUrl, FILTER_VALIDATE_URL) !== false) {
            return $imageUrl;
        }

        // Handle the case where the API response does not contain a valid image URL
        return null;
    }

    public function handleRequest($in_brand,$in_model){
        // Extract parameters from the query string
        $brand = $in_brand ?? null;
        $model = $in_model ?? null;

        if ($brand === null) {
            return api2::APIURL;
        }

        // Build query parameters
        $queryParams = ['brand' => $brand];

        // If model is provided, add it to the query parameters
        if ($model !== null) {
            $queryParams['model'] = $model;
        }

        // Get the image URL
        $url = $this->getImageUrl($queryParams);

        if ($url === null) {
            return api2::APIURL;
        } else {
            return ($url);
        }
    }
}

$api2 = new api2();

if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    // This block will only be executed for non-AJAX requests (e.g., manual testing)
    if($api2->verifyUser('jtNHItJM5pkouGLf')){

        $api2->getData($requestData);

    }
    else{

        echo json_encode([
            "success" => false,
            "message" => "invalid user",
            "data" => []
        ]);
        die();
    }

}


