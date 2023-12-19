<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once './api.php';

class GetImage {


    protected function getImageUrl($queryParams): string|null {
        // Construct the full URL with query parameters
        $urlWithParams = GetImage::APIURL . '?' . http_build_query($queryParams);

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
            $this->respondWithError();
            return GetImage::APIURL;
        }

        // Build query parameters
        $queryParams = ['brand' => $brand];

        // If model is provided, add it to the query parameters
        if ($model !== null) {
            $queryParams['model'] = $model;
        }

        // Get the image URL
        $url = $this->getImageUrl($queryParams);
        var_dump($url);
        if ($url === null) {
            return GetImage::APIURL;
        } else {
            return ($url);
        }
    }

    private function respondWithSuccess($url):void
    {
        // Determine the content type based on the image file extension
        $contentType = mime_content_type($url);
        header("HTTP/1.1 200 OK");
        header('Content-Type: ' . $contentType);

        // Output the image content
        echo ($url);
    }

    private function respondWithError():void
    {
        $contentType = mime_content_type(GetImage::DEFAULT_IMAGE);
        header('Content-Type: ' . $contentType);
        echo GetImage::DEFAULT_IMAGE;
    }



}