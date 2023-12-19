<?php
/*// Your API endpoint URL
$apiUrl = 'https://localhost/api/';

// Data to be sent in the POST request
$postData = [
    'apikey' => 'your_api_key',
    'type' => 'some_type',
    'return' => 'some_return',
    // ... other optional data
];

// Convert data to JSON
$jsonData = json_encode($postData);

// Initialize cURL session
$ch = curl_init($apiUrl);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData),
]);

// Execute cURL session and get the response
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
}

// Close cURL session
curl_close($ch);

// Decode the JSON response
$responseData = json_decode($response, true);

// Check the status and handle the data accordingly
if ($responseData['status'] === 'success') {
    $message = $responseData['message'];
    $data = $responseData['data'];

    // Handle the data as needed
    echo "Status: $message\n";
    echo "Returned data: \n";
    print_r($data);
} else {
    // Handle the error
    $errorMessage = $responseData['message'];
    echo "Error: $errorMessage\n";
}*/

