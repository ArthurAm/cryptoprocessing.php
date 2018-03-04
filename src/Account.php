<?php

namespace Cryptoprocessing;

/**
 * Class Account
 *
 * Methods for working with accounts
 *
 * @package Cryptoprocessing
 * @see https://api.cryptoprocessing.io/#db40c5d3-078d-af2a-63e0-fd616f56e433
 */
class Account
{
    /**
     * @var string Currency
     */
    private static $blockchainType = 'btc';

    /**
     * Create account for given currency and with given name
     * @param string $name Account name
     * @param array $options Additional parameters
     * @return object
     * @see https://api.cryptoprocessing.io/#7b3bacaf-aa8e-77ad-4d0d-f834b10ebc95
     */
    public static function createAccount($name = '', array $options = [])
    {
        $params['currency'] = isset($options['currency']) ? $options['currency'] : self::getBlockchaintype();

        if($name)
            $params['name'] = $name;

        $requestData = Request::sendRequest('POST', 'api/v1/accounts', $params);

        return $requestData;
    }

    /**
     * Shows account data by id
     * @param string $accountId Account id, required
     * @param array $options
     * @return object
     * @see https://api.cryptoprocessing.io/#4df50869-9044-21b6-bb27-a718f30e0040
     */
    public static function getAccountInfo($accountId, array $options = [])
    {
        $currency = isset($options['currency']) ? $options['currency'] : self::getBlockchaintype();

        return Request::sendRequest('GET', 'api/v1/' . $currency . '/accounts/' . $accountId);
    }

    /**
     * Shows used currency
     * @return string
     */
    public static function getBlockchaintype()
    {
        return self::$blockchainType;
    }

    /**
     * Set currency
     * @param string $blockchainType New currency, required
     */
    public static function setBlockchaintype($blockchainType)
    {
        self::$blockchainType = $blockchainType;
    }
}