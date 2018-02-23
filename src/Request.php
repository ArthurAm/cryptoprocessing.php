<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 23.02.18
 * Time: 20:05
 */

namespace Cryptoprocessing;

use GuzzleHttp\Client;

class Request
{
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => Config::getApiServerUrl(),
        ]);
    }

    public function sendRequest($method, $apiUri, array $parameters) {
        $headers = ['Content-Type' => 'application/json'];

        if($method === 'GET')
            $response = $this->client->request($method, $apiUri,[
                'headers' => $headers,
                'query' => $parameters
            ]);
        elseif ($method === 'POST')
            $response = $this->client->request($method, $apiUri, [
                'headers' => $headers,
                'json' => $parameters
            ]);

        return json_decode($response->getBody());
    }
}