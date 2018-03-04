<?php

namespace Cryptoprocessing;

/**
 * Class Authentication
 *
 * Api authentication methods
 *
 * @package Cryptoprocessing
 * @see https://api.cryptoprocessing.io/#152a3087-a02e-de76-f156-2015c2ccefef
 */
class Authentication
{
    /**
     * Api authorization token
     * @var string
     */
    private static $authToken;

    /**
     * User Id
     * @var string
     */
    private static $userId;

    /**
     * Shows api authorization token
     * @return string
     */
    public static function getToken()
    {
        return self::$authToken;
    }

    /**
     * Set api auth token
     * @param string $authToken
     */
    public static function setToken($authToken)
    {
        self::$authToken = $authToken;
    }

    /**
     * Shows user id
     * @return string
     */
    public static function getUserId()
    {
        return self::$userId;
    }

    /**
     * Set api User Id
     * @param string $userId
     */
    public static function setUserId($userId)
    {
        self::$userId = $userId;
    }

    /**
     * User registration
     * @param string $email User email, required
     * @param string $password User password, required
     * @return object
     * @see https://api.cryptoprocessing.io/#b0ec8c86-4c57-de45-5aea-e1cb6483e591
     */
    public static function register($email, $password)
    {
        $parameters = [
            'email' => $email,
            'password' => $password
        ];

        $requestData = Request::sendRequest('POST', 'api/auth/register', $parameters);

        self::setToken($requestData->auth_token);
        self::setUserId($requestData->user_id);

        return $requestData;
    }

    /**
     * User login
     * @param string $email User email, required
     * @param string $password User password, required
     * @return object
     * @see https://api.cryptoprocessing.io/#e88a61dc-bb8f-e9cf-0e56-2729f200be9d
     */
    public static function login($email, $password)
    {
        $parameters = [
            'email' => $email,
            'password' => $password
        ];

        $requestData = Request::sendRequest('POST', 'api/auth/login', $parameters);

        self::setToken($requestData->auth_token);
        self::setUserId($requestData->user_id);

        return $requestData;
    }
}