<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 24.02.18
 * Time: 18:11
 */

namespace Cryptoprocessing;


class Transaction
{
    const TRANSACTION_SEND_TYPE = 'send';
    const TRANSACTION_SEND_TYPE_RAW = 'sendraw';
    const TRANSACTION_FEE_FASTEST = 'fastestFee';
    const TRANSACTION_FEE_HALF_HOUR = 'halfHourFee';
    const TRANSACTION_FEE_HOUR = 'hourFee';


    public function transactionsList($accountId, $options = ['limit' => '50', 'offset' => '1'])
    {
        $currency = $options['currency'] ? $options['currency'] : Account::getBlockchaintype();

        $params['limit'] = $options['limit'];
        $params['offset'] = $options['offset'];

        return Request::sendRequest('GET', "api/v1/$currency/accounts/$accountId/transactions", $params);
    }

    public function transactionsListByAddress($accountId, $address, $options = [])
    {
        $currency = $options['currency'] ? $options['currency'] : Account::getBlockchaintype();

        return Request::sendRequest('GET', "api/v1/$$currency/accounts/$accountId/transactions/address/$address");
    }

    public function sendRowTransaction($raw_transaction_id, $options = [])
    {
        $currency = $options['currency'] ? $options['currency'] : Account::getBlockchaintype();

        $params['type'] = $options['type'] ? $options['type'] : self::TRANSACTION_SEND_TYPE_RAW;
        $params['raw_transaction_id'] = $raw_transaction_id;

        if($options['description'])
            $params['description'] = $options['description'];

        return Request::sendRequest('POST', "api/v1/$currency/sendrawtx", $params);
    }

    public function createTransaction($accountId, $options = [])
    {
        $currency = $options['currency'] ? $options['currency'] : Account::getBlockchaintype();

        $params['type'] = $options['type'] ? $options['type'] : self::TRANSACTION_SEND_TYPE;
        $params['fee'] = $options['fee'] ? $options['fee'] : self::TRANSACTION_FEE_FASTEST;

        if($options['from'])
            $params['from_'] = $options['from'];

        if($options['to'])
            $params['to_'] = $options['to'];

        if($options['idem'])
            $params['idem'] = $options['idem'];

        if($options['description'])
            $params['description'] = $options['description'];

        return Request::sendRequest('POST', "api/v1/$currency/accounts/$accountId/transactions", $params);
    }
}