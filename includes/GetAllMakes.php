<?php
require_once '../config.php';
require_once './api.php';

class GetAllMakes extends api{
    protected function getAllMakes ()
    {
        global $db;

        $query = "SELECT make FROM cars ";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute();

            // Bind the result variable
            $stmt->bind_result($make);

            // Fetch all rows
            $makes = [];
            while ($stmt->fetch()) {
                $makes[] = $make;
            }

            // Return the makes array
            return $makes;
        } catch (Exception $e) {
            // Handle the exception (log, display an error, etc.)
            echo "Error: " . $e->getMessage();
            echo "Error fetching call makes.";
            return null;
        }
    }

    protected function handelRequest(){
        //get the JSON data from the request body
        $jsonInput = file_get_contents('php://input');

        //decode the JSON into an associative array
        $requestData = json_decode($jsonInput,true);

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


        // Respond with a success message
        $this->respondWithSuccess('Request processed successfully.');
    }

    private function respondWithSuccess($message)
    {
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => $message]);
    }

    private function respondWithError($message)
    {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => $message]);
    }
}

