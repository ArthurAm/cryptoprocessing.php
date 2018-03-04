<?php

namespace Cryptoprocessing;

/**
 * Class Transaction
 *
 * Transaction methods
 *
 * @package Cryptoprocessing
 */
class Transaction
{
    const TRANSACTION_SEND_TYPE = 'send';
    const TRANSACTION_SEND_TYPE_RAW = 'sendraw';
    const TRANSACTION_FEE_FASTEST = 'fastestFee';
    const TRANSACTION_FEE_HALF_HOUR = 'halfHourFee';
    const TRANSACTION_FEE_HOUR = 'hourFee';

    /**
     * Shows all account transactions
     * @param string $accountId Account Id, required
     * @param array $options
     * @return object
     * @see https://api.cryptoprocessing.io/#690f04ca-cc2b-750b-17c6-4cc290a65d98
     */
    public static function transactionsList($accountId, $options = ['limit' => '50', 'offset' => '1'])
    {
        $currency = isset($options['currency']) ? $options['currency'] : Account::getBlockchaintype();

        $params['limit'] = $options['limit'];
        $params['offset'] = $options['offset'];

        return Request::sendRequest('GET', "api/v1/$currency/accounts/$accountId/transactions", $params);
    }

    /**
     * Shows all address transactions
     * @param string $accountId Account Id, required
     * @param $address Crypto address, required
     * @param array $options Additional parameters
     * @return object
     * @see https://api.cryptoprocessing.io/#0e6e0dbc-1c1b-23db-dc54-a3b36ed276d8
     */
    public static function transactionsListByAddress($accountId, $address, $options = [])
    {
        $currency = isset($options['currency']) ? $options['currency'] : Account::getBlockchaintype();

        return Request::sendRequest('GET', "api/v1/$currency/accounts/$accountId/transactions/address/$address");
    }

    /**
     * Send row transaction
     * @param string $raw_transaction_id Transaction id, required
     * @param array $options Additional parameters
     * @return object
     * @see https://api.cryptoprocessing.io/#655161a4-f6ff-6764-1667-8fb039912546
     */
    public static function sendRowTransaction($raw_transaction_id, $options = [])
    {
        $currency = isset($options['currency']) ? $options['currency'] : Account::getBlockchaintype();

        $params['type'] = isset($options['type']) ? $options['type'] : self::TRANSACTION_SEND_TYPE_RAW;
        $params['raw_transaction_id'] = $raw_transaction_id;

        if(isset($options['description']))
            $params['description'] = $options['description'];

        return Request::sendRequest('POST', "api/v1/$currency/sendrawtx", $params);
    }

    /**
     * Create transaction by params
     * @param string $accountId Account id, required
     * @param array $options Transaction parameters
     *      $options = [
     *          'from' => array Source addresses list, required
     *          'to'   => [    array Destination address list with amounts, required
     *              [
     *                  'address' => Destination address, required
     *                  'amount'  => Amount for payment, indicated in Satoshi
     *              ],
     *              ......
     *          ]
     *          'type' => string Transaction send type, send or row, required
     *          'description' => string Transaction description
     *          'idem' => string Unique transaction identifier
     *      ]
     * @return object
     * @throws ApiException
     * @see https://api.cryptoprocessing.io/#8dd94a75-4b09-588e-c9ad-c9cb5f165d72
     */
    public static function createTransaction($accountId, $options = [])
    {
        $currency = isset($options['currency']) ? $options['currency'] : Account::getBlockchaintype();

        $params['type'] = isset($options['type']) ? $options['type'] : self::TRANSACTION_SEND_TYPE;
        $params['fee'] = isset($options['fee']) ? $options['fee'] : self::TRANSACTION_FEE_FASTEST;

        if(isset($options['from'])) {
            $params['from_'] = $options['from'];
            if(!is_array($options['from']))
                throw new ApiException('Input address should be array');
        }

        if(isset($options['to'])) {
            $params['to_'] = $options['to'];

            if (!is_array($options['to']))
                throw new ApiException('Output address should be array');

            foreach($options['to'] as $output)
                if(empty($output['address']))
                    throw new ApiException('Empty output address');

        } else
            throw new ApiException('No output address');

        if(isset($options['idem']))
            $params['idem'] = $options['idem'];

        if(isset($options['description']))
            $params['description'] = $options['description'];

        return Request::sendRequest('POST', "api/v1/$currency/accounts/$accountId/transactions", $params);
    }
}