<?php
header('Content-type:application/json;charset=utf-8');

require_once('../vendor/autoload.php');
require_once('./MyCurl.php');
require_once('./HotelLoader.php');

// Loading environment variables from .env
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

$raw_api_key = $_ENV['RAW_API_KEY'];
$host = $_ENV['HOST'];
$url = $_ENV['URL'];

// Getting the iso parameter
$iso =
  filter_input(INPUT_GET, 'iso', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
// Request parameters
$collection_name = 'hotels';
$request_url = "{$url}{$iso}/{$collection_name}";
$api_key = sha1($raw_api_key);
$curl_options = array(
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "Host: $host",
    "X-API-Key: $api_key",
    'Content-Type: application/json'
  ]
);

// Getting data
$my_curl = new MyCurl($request_url, $curl_options);
$curl_response = $my_curl->getData();

$hotels = $curl_response["data"];
//$hotel_loader = new HotelLoader($hotels);

$response = $curl_response;

echo json_encode($response);
