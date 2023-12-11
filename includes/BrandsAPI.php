<?php

require_once '../api.php';



// Brands array
$brands = ["Alfa Romeo", "Aston Martin", "Audi", "AC", "BMW", "Bugatti", "Ferrari", "Genesis", "Jaguar", "Lamborghini", "Maybach", "Mercedes-Benz", "Mini", "Porsche", "Rolls-Royce"];

// Array to store image URLs
$imageUrls = [];

// Create an associative array to map brand names to their image URLs
$brandImageMap = [];

// Spinner functions
function showLoadingSpinner()
{
    echo '<div id="loading-spinner" style="display: flex;"></div>';
}

function hideLoadingSpinner()
{
    echo '<div id="loading-spinner" style="display: none;"></div>';
}

showLoadingSpinner();

// API call function
function ApiCall($brandName, $callback)
{
// Create an instance of the api class
    $api = new api();

// Call the handleRequest method
    $api->handleRequest();
    echo '<script> console.log("making api call for  '. $brandName .'");</script>';
    $defaultUrl = "https://dealeraccelerate-all.s3.amazonaws.com/fastlane/marketing_assets/428/90020_a1909487_v2.jpg";
    $url = "https://localhost/api/getimage";
    $params = ["make" => $brandName];

    // Append the parameters to the URL
    $url .= "?" . http_build_query($params);

    // Initialize cURL session
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session
    $response = curl_exec($ch);
    echo '<script> console.log("Response:   '. $response .'");</script>';

    // Check for errors
    if (curl_errno($ch)) {
        // Handle an error (e.g., display an error message)
        error_log("cURL error: " . curl_error($ch));
        $callback($defaultUrl);
    } else {
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode == 200) {
            $callback($response);
        } else {
            // Handle an error (e.g., display an error message)
            error_log("Request failed with status: " . $httpCode);
            $callback($defaultUrl);
        }
    }

    // Close cURL session
    curl_close($ch);
}

// Function to call the API for a brand and store the URL
function callApiAndStoreUrl($brandName)
{
    echo '<script> console.log("Im here");</script>';
    global $brandImageMap;

    ApiCall($brandName, function ($imageUrl) use ($brandName) {
        // Store the URL in the brandImageMap using the brandName as the key
        $brandImageMap[$brandName] = $imageUrl;

        // Check if all requests are completed
        if (count($brandImageMap) === count($GLOBALS['brands'])) {
            echo '<script>console.log("image URLs have been loaded.");</script>';
            processData();
        }
    });
}

// Loop through the brand names and call the API for each one
echo '<script> console.log("H1");</script>';
array_map('callApiAndStoreUrl', $brands);

// Function to create a brand card
function brandCard($imageUrl, $brandName)
{
    // Create the card
    $card = '<div class="content-card">';

    // Create picture area
    $card .= '<div class="row-1">';
    $card .= '<div class="brand-pic">';
    $card .= '<div class="brand-logo" style="background-image: url( '.$imageUrl .');"></div>';
    $card .= '</div>';
    $card .= '</div>';

    // Create second row of the card
    $card .= '<div class="row-2">';
    $card .= '<a href="Cars.php">';
    $card .= '<div class="brand-name">';
    $card .= '<h2>' . $brandName . '</h2>';
    $card .= '</div>';
    $card .= '</a>';
    $card .= '</div>';

    // Set the card ID
    $card .= 'id="' . removeSpaces($brandName) . '"';

    // Close the card
    $card .= '</div>';

    // Return the created card
    return $card;
}

// Function to populate the page with brand cards
function populateCards()
{
    global $brandImageMap;

    // Add to content area
    echo '<div class="content">';

    // Index for the brands array
    $index = 0;

    // 15 brands = 5 content areas
    for ($i = 0; $i < 5; $i++) {
        // Create content-card-area
        echo '<div class="content-card-area">';

        // Add 3 brand cards to the area
        if ($index < count($GLOBALS['brands'])) {
            echo brandCard($brandImageMap[$GLOBALS['brands'][$index]], $GLOBALS['brands'][$index]);
            $index++;
        }

        if ($index < count($GLOBALS['brands'])) {
            echo brandCard($brandImageMap[$GLOBALS['brands'][$index]], $GLOBALS['brands'][$index]);
            $index++;
        }

        if ($index < count($GLOBALS['brands'])) {
            echo brandCard($brandImageMap[$GLOBALS['brands'][$index]], $GLOBALS['brands'][$index]);
            $index++;
        }

        // Close the content-card-area
        echo '</div>';
    }

    // Close the content area
    echo '</div>';
}

// Remove spaces from a string for the card ID
function removeSpaces($inputString)
{
    return str_replace(' ', '', $inputString);
}

// Function to process data after all API calls are done
function processData()
{
    hideLoadingSpinner();
    populateCards();
}

