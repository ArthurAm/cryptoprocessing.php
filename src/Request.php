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
    public static function sendRequest($method, $apiUri, array $parameters = []) {
        $client = new Client([
            'base_uri' => Config::getApiServerUrl(),
        ]);

        $headers = ['Content-Type' => 'application/json'];

        if(Authentication::getToken())
            $headers['Authorization'] = Authentication::getToken();

        if($method === 'GET')
            $response = $client->request($method, $apiUri,[
                'http_errors' => false,
                'headers' => $headers,
                'query' => $parameters
            ]);
        elseif ($method === 'POST')
            $response = $client->request($method, $apiUri, [
                'http_errors' => false,
                'headers' => $headers,
                'json' => $parameters
            ]);

        $response = json_decode($response->getBody());

        if($response->status == 'fail')
            throw new \Exception($response->message);
        else
            return $response;
    }
}