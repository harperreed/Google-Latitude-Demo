<?php

require_once("config.php");

// Retrieve the access token and creat an HTTP Client
if(!$accessToken=unserialize(file_get_contents('token.txt'))) die('Unable to read access token. Have your authorised your app? run: php oauth.php');
$client = $accessToken->getHttpClient($oauthOptions);

// Request the current location
$client->setUri('https://www.googleapis.com/latitude/v1/currentLocation');
$client->setParameterGet("granularity", "best");
$client->setMethod(Zend_Http_Client::GET);

// Get Response and decode
$response = $client->request();
$content = $response->getBody();
$location = (json_decode($content));

// Reverse geocode
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://maps.google.com/maps/api/geocode/json?latlng={$location->data->latitude},{$location->data->longitude}&sensor=false"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$output = curl_exec($ch); 
curl_close($ch);      

// Identify most accurate result (assuming returned first)
$addresses = json_decode($output);
$address = $addresses->results[0];

// Display current location
echo "\nCurrent Location:\n";
echo "  lat:     {$location->data->latitude}\n";
echo "  lon:     {$location->data->longitude}\n";
echo "  place:   {$address->formatted_address}\n";
echo "  updated: " . date("r", $location->data->timestampMs/1000) . "\n\n";

?>