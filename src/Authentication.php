<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 24.02.18
 * Time: 17:58
 */

namespace Cryptoprocessing;


/**
 * Class Authentication
 * @package Cryptoprocessing
 */
class Authentication
{
    public static $authToken = '';
    public static $userId = '';

    /**
     * @param $email
     * @param $password
     */
    public static function register($email, $password)
    {
        $parameters = [
            'email' => $email,
            'password' => $password
        ];

        $requestData = Request::sendRequest('POST', 'api/auth/register', $parameters);

        self::$authToken = $requestData->auth_token;
        self::$userId = $requestData->user_id;

        return $requestData;
    }

    /**
     * @param $email
     * @param $password
     */
    public static function login($email, $password)
    {
        $parameters = [
            'email' => $email,
            'password' => $password
        ];

        $requestData = Request::sendRequest('POST', 'api/auth/login', $parameters);

        self::$authToken = $requestData->auth_token;
        self::$userId = $requestData->user_id;

        return $requestData;
    }

    public static function getToken()
    {
        return self::$authToken;
    }

    public static function getUserId()
    {
        return self::$userId;
    }
}