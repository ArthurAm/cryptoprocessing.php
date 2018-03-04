<?php

namespace Cryptoprocessing;

/**
 * Class Callback
 *
 * Callback methods
 *
 * @package Cryptoprocessing
 * @see https://api.cryptoprocessing.io/#e8bbf0e7-38e7-3e98-17f5-04733f419242
 */
class Callback
{
    /**
     * Shows account callback list
     * @param string $accountId Account id, required
     * @param array $options Additional params
     * @return object
     * @see https://api.cryptoprocessing.io/#e8bbf0e7-38e7-3e98-17f5-04733f419242
     */
    public static function callbackList($accountId, array $options = [])
    {
        $currency = isset($options['currency']) ? $options['currency'] : Account::getBlockchaintype();

        return Request::sendRequest('GET', "api/v1/$currency/accounts/$accountId/callback");
    }

    /**
     * Create callback
     * @param string $accountId Account id, required
     * @param string $address Callback address, required
     * @param array $options Additional params
     * @return object
     * @see https://api.cryptoprocessing.io/#62b671c8-ba1c-5101-37a8-1ddf3dafb758
     */
    public static function createCallback($accountId, $address ,array $options = [])
    {
        $currency = isset($options['currency']) ? $options['currency'] : Account::getBlockchaintype();

        return Request::sendRequest('POST', "api/v1/$currency/accounts/$accountId/callback", ['address' => $address]);
    }
}