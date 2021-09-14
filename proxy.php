<?php
require_once 'vendor/autoload.php';

// Get the information
$url = $_GET['url'];
$data = $_GET['data'];
$method = $_GET['method'];

// Guzzle
try {
    $client = new \GuzzleHttp\Client;

    $response = $client->request($method, $url, [
        'body' => $data,
        'connect_timeout' => 3
    ]);

    $responseStatus = $response->getStatusCode();
    $responseBody = $response->getBody()->getContents();

    echo json_encode([
        'response_code' => $responseStatus,
        'response_body' => $responseBody,
        'success' => true
    ]);
} catch (\GuzzleHttp\Exception\RequestException $e) {
    echo json_encode([
        'response_code' => $e->getResponse()->getStatusCode(),
        'response_body' => $e->getResponse()->getBody(),
        'success' => false,
    ]);
}
