<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 23.02.18
 * Time: 18:28
 */

namespace Cryptoprocessing;

class Register
{
    private static $registerUri = 'api/auth/register';
    private static $method = 'POST';

    public function __construct($email, $password)
    {
        $connect = new Request();

        $parameters = [
            'email' => $email,
            'password' => $password
        ];

        $this->requestData = $connect->sendRequest(self::$method, self::$registerUri, $parameters);
    }
}