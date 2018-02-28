<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 28.02.18
 * Time: 21:38
 */

namespace Cryptoprocessing;


class Callback
{
    public function callbackList($accountId)
    {
        return Request::sendRequest('GET', 'api/v1/self::$blockchainType/accounts/$accountId/callback');
    }

    public function createCallback($accountId, $address)
    {
        return Request::sendRequest('POST', 'api/v1/self::$blockchainType/accounts/$accountId/callback', [
            'address' => $address
        ]);
    }
}