<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 24.02.18
 * Time: 18:10
 */

namespace Cryptoprocessing;


class Account
{
    private static $blockchainType = 'btc';
    private static $accountId = '';

    public static function createAccount($currency, $name)
    {

        $requestData = Request::sendRequest('POST', 'api/v1/accounts', [
            'currency' => $currency,
            'name' => $name
        ]);

        self::$blockchainType = $currency;

        return $requestData;
    }

    public static function getAccountInfo($accountId)
    {
        return Request::sendRequest('GET', "api/v1/self::$blockchainType/$accountId");
    }

    public static function getBlockchaintype()
    {
        return self::$blockchainType;
    }

    public static function setBlockchaintype($blockchainType)
    {
        self::$blockchainType = $blockchainType;
    }

    public static function getAccountId()
    {
        return self::$accountId;
    }
}