<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 28.02.18
 * Time: 21:34
 */

namespace Cryptoprocessing;


class Tracking
{
    public function addTrAddress($accountId, $address, $description = '', $options = [])
    {
        $currency = $options['currency'] ? $options['currency'] : Account::getBlockchaintype();

        $params['address'] = $address;

        if($description)
            $params['description'] = $description;

        return Request::sendRequest('POST', "api/v1/$currency/accounts/$accountId/tracing/address", $params);
    }

    public function getTrAddressList($accountId, $options = [])
    {
        $currency = $options['currency'] ? $options['currency'] : Account::getBlockchaintype();

        return Request::sendRequest('GET', "api/v1/$currency/accounts/$accountId/tracing/address");

    }
}