<?php

namespace Cryptoprocessing;

/**
 * Class Tracking
 *
 * Tracking methods
 *
 * @package Cryptoprocessing
 * @see https://api.cryptoprocessing.io/#bb7723d0-761b-46cd-f6ed-9ca2699f47df
 */
class Tracking
{
    /**
     * Add address for tracking
     *
     * @param string $accountId Account id, required
     * @param string $address Crypto address, required
     * @param string $description Description
     * @param array $options Additional parameters
     * @return object
     * @see https://api.cryptoprocessing.io/#bb7723d0-761b-46cd-f6ed-9ca2699f47df
     */
    public static function addTrAddress($accountId, $address, $description = '', $options = [])
    {
        $currency = isset($options['currency']) ? $options['currency'] : Account::getBlockchaintype();

        $params['address'] = $address;

        if($description)
            $params['description'] = $description;

        return Request::sendRequest('POST', "api/v1/$currency/accounts/$accountId/tracing/address", $params);
    }

    /**
     * Shows tracking addresses
     * @param string $accountId Account id, required
     * @param array $options Additional parameters
     * @return object
     * @see https://api.cryptoprocessing.io/#cb331d76-0685-59d0-dbab-9c0473b2ca4b
     */
    public static function addressTrList($accountId, $options = [])
    {
        $currency = isset($options['currency']) ? $options['currency'] : Account::getBlockchaintype();

        return Request::sendRequest('GET', "api/v1/$currency/accounts/$accountId/tracing/address");
    }
}