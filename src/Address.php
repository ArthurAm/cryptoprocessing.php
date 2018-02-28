<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 24.02.18
 * Time: 18:11
 */

namespace Cryptoprocessing;


class Address
{
    public static function addAddress($accountId, $name = '', array $options = [])
    {
        $currency = $options['currency'] ? $options['currency'] : Account::getBlockchaintype();

        if($name)
            $params['name'] = $name;

        return Request::sendRequest('POST', "api/v1/$currency/accounts/$accountId/addresses", $params);
    }

    public static function addressList($accountId, array $options = [])
    {
        $currency = $options['currency'] ? $options['currency'] : Account::getBlockchaintype();

        return Request::sendRequest('GET', "api/v1/$currency/accounts/$accountId/addresses");
    }

    public static function showAddress($accountId, $address, array $options = [])
    {
        $currency = $options['currency'] ? $options['currency'] : Account::getBlockchaintype();

        return Request::sendRequest('GET', "api/v1/$currency/accounts/$accountId/addresses/$address");
    }
}