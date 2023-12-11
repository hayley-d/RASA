<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

class GetAllCars {
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

        /*if($search !== null)
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
        }*/

        // Execute the statement
        $stmt->execute();

        // Get the result set
        $result = $stmt->get_result();

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

    protected  function handelReturn(string|array $return,array $database_results):array
    {
        $results = [];
        //function filters out any unwanted data
        if(gettype($return)==='string')
        {
            return $database_results;
        }
        else{
            foreach($return as $key)
            {
                // Check if the key exists in the database results
                if (array_key_exists($key, $database_results)) {
                    $results[$key] = $database_results[$key];
                } else {
                    // Handle non-existent key (you can log a warning or take other actions)
                    echo "Error invalid key: ".$key;
                }
            }
            $getImage = new GetImage();
            foreach ($results as $result) {
                $image = $getImage->handleRequest($result['make'], $result['model']);
                $result['image'] = $image;
            }

            return $results;
        }
    }

    public function handelRequest($db,$requestData){

        // Check if the required keys are present in the request
        $requiredKeys = ['apikey', 'type', 'return'];

        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $requestData)) {
                $this->respondWithError("Missing '$key' in the request.");
                return;
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
                $data = GetAllCars::getAllMakes($db);
                if($data !== null)
                {
                    $this->respondWithSuccess($data);
                }
                else{
                    $this->respondWithSuccess([]);
                    return;
                }

            }
            else if($type === 'GetAllCars'){
                //get the data
                $data = GetAllCars::getCars($db,$limit,$sort,$order,$search,$fuzzy);
                if($data !== null)
                {
                    $finalData = GetAllCars::handelReturn($return,$data);
                    //an associative array
                    $this->respondWithSuccess($finalData);
                }
                else{
                    $this->respondWithSuccess([]);
                    return;
                }
            }
            else{
                $this->respondWithError("Wrong request type.");
                return;
            }

        }
        else{
            $this->respondWithError("User API KEY invalid.");
        }
    }

    private function respondWithSuccess($data):void
    {
        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'data' => $data]);
    }

    private function respondWithError($message):void
    {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => $message]);

    }

    protected function verifyUser($apikey):bool
    {
        global $db;

        $query = "SELECT apikey FROM users WHERE apikey = ?";

        try {
            $stmt = $db->prepare($query);
            $stmt->bind_param("s", $apikey); // 's' indicates a string parameter
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

}

