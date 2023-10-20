<?php
namespace Names;

use GuzzleHttp\Client;

class ApiDataRetriever
{
    public function retrieveApiData(string $apiUrl): string
    {
        $client = new Client();

        // Send a GET request to the API URL
        $response = $client->get($apiUrl);

        if ($response->getStatusCode() === 200) {
            echo "Status Code: " . $response->getStatusCode() . "\n";
        }
        return (string)$response->getBody();
    }
}