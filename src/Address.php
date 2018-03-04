<?php

namespace Cryptoprocessing;

/**
 * Class Address
 *
 * Methods for working with addresses
 *
 * @package Cryptoprocessing
 * @see https://api.cryptoprocessing.io/#be1b38bb-7702-51c6-192f-91cf3a506ae8
 */
class Address
{
    /**
     * Add new address to account
     * @param string $accountId Account id, required
     * @param string $name Address name
     * @param array $options Additional parameters
     * @return object
     * @see https://api.cryptoprocessing.io/#d6486a95-a5cb-4d4b-0369-0c7af040bc4d
     */
    public static function addAddress($accountId, $name = '', array $options = [])
    {
        $currency = isset($options['currency']) ? $options['currency'] : Account::getBlockchaintype();

        if($name)
            $params['name'] = $name;

        return Request::sendRequest('POST', "api/v1/$currency/accounts/$accountId/addresses", $params);
    }

    /**
     * Shows account addresses
     * @param string $accountId Account id, required
     * @param array $options Additional parameters
     * @return object
     * @see https://api.cryptoprocessing.io/#b826594e-db0d-4efe-04e9-c1286e6f8948
     */
    public static function addressList($accountId, array $options = [])
    {
        $currency = isset($options['currency']) ? $options['currency'] : Account::getBlockchaintype();

        return Request::sendRequest('GET', "api/v1/$currency/accounts/$accountId/addresses");
    }

    /**
     * Shows address data
     * @param string $accountId Account id, required
     * @param string $address Address, required
     * @param array $options Additional parameters
     * @return object
     * @see https://api.cryptoprocessing.io/#55759d22-b04b-1a63-ca8d-6b881b0212b2
     */
    public static function showAddress($accountId, $address, array $options = [])
    {
        $currency = isset($options['currency']) ? $options['currency'] : Account::getBlockchaintype();

        return Request::sendRequest('GET', "api/v1/$currency/accounts/$accountId/addresses/$address");
    }
}