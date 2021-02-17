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
$iso_country_id =
  filter_input(INPUT_GET, 'iso_country_id', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

// Request parameters
$collection_name = 'hotels';
$request_url = "{$url}{$iso_country_id}/{$collection_name}";
$api_key = sha1($raw_api_key);

$curl_options = array(
  CURLOPT_URL => $request_url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "Host: $host",
    "X-API-Key: $api_key",
    'Content-Type: application/json'
  ],
  CURLOPT_FAILONERROR => true
);

// Getting data from API
$my_curl = new MyCurl();
$curl_response = $my_curl->getData($curl_options);

$hotels = $curl_response["data"];
$error = $curl_response["error"];
$data = null;

if ($hotels) {
  $hotel_loader = new HotelLoader($hotels);
  var_dump($hotel_loader->average_score);
  $data = array(
    'iso_country_id' => $iso_country_id,
    'average_score' => $hotel_loader->average_score,
    'top_hotels' => $hotel_loader->topHotels()
  );
}

if (!$data && !$error) {
  $error = 'Something went wrong';
  $data = array(
    'iso_country_id' => $iso_country_id
  );
}

$response = array('error' => $error, 'data' => $data);

echo json_encode($response);
