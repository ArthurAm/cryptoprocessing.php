<?php

namespace Cryptoprocessing;

use GuzzleHttp\Client;
use GuzzleHttp\Middleware;

/**
 * Class Request
 *
 * Request methods
 *
 * @package Cryptoprocessing
 */
class Request
{
    /**
     * Bitcoin mainnode address
     * @var string
     */
    private static $apiServerUrl = 'http://13.93.88.74';

    /**
     * Set Api server url
     * @param $url
     */
    public static function setApiServerUrl($url)
    {
        self::$apiServerUrl = $url;
    }

    /**
     * Send GET or POST requests to api with needed parameters
     *
     * @param string $method GET or POST, required
     * @param string $apiUri Api uri, required
     * @param array $parameters Additional parameters
     * @return object
     * @throws ApiException
     */
    public static function sendRequest($method, $apiUri, array $parameters = []) {
        $client = new Client([
            'base_uri' => self::$apiServerUrl,
        ]);

        $headers = ['Content-Type' => 'application/json'];

        if(Authentication::getToken())
            $headers['Authorization'] = 'Bearer ' . Authentication::getToken();

        $clientHandler = $client->getConfig('handler');
        $tapMiddleware = Middleware::tap(function ($request) {
            echo $request->getHeaderLine('Content-Type');
            echo $request->getBody();
        });


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
                'json' => $parameters,
                //'handler' => $tapMiddleware($clientHandler)
            ]);

        $response = json_decode($response->getBody());

        if(!$response)
            throw new ApiException('Empty Api Response');

        if(isset($response->status) && $response->status == 'fail')
            throw new ApiException($response->message);
        else
            return $response;
    }
}