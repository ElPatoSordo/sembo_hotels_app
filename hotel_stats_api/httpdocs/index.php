<?php
require('../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

// Getting environment variables
$email = $_ENV['EMAIL_FOR_API_KEY'];
$host = $_ENV['HOST'];
$url = $_ENV['URL'];


$iso = 'es';
$collection_name = 'hotels';

$request_url = "{$url}{$iso}/{$collection_name}";

$api_key = sha1($email);

$curl = curl_init($request_url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
  "Host: $host",
  "X-API-Key: $api_key",
  'Content-Type: application/json'
]);

$response = curl_exec($curl);
curl_close($curl);

echo $response . PHP_EOL;
