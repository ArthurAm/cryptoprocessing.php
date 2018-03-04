<?php
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    private static $testApiEndpoint = 'http://13.80.23.30';
    private static $email = 'phptest@test.com';
    private static $password = '123321';
    private static $authToken;
    private static $userId = '41feeab6-9a59-44f3-a0aa-eaa681a11f23';
    private static $accountId = '9d740c98-b056-4dd0-82a3-3f86d4ba4a8e';
    private static $address = 'mx6xsCQ8AZNjic4FLu7mhTW4aFSXtFiVZT';
    private static $addressId = 'e542359f-a8df-461b-b46b-09cc80687638';

    public function setUp()
    {
        \Cryptoprocessing\Request::setApiServerUrl(self::$testApiEndpoint);
    }

    /**
     * @expectedException \Cryptoprocessing\ApiException
     */
    public function testGetApiRequestSend()
    {
        $request = \Cryptoprocessing\Request::sendRequest('GET', 'api/v1/btc/accounts');
    }

    /**
     * @expectedException \Cryptoprocessing\ApiException
     */
    public function testPostApiRequestSend()
    {
        $request = \Cryptoprocessing\Request::sendRequest('POST', 'api/v1/accounts');
    }

    /**
     * @expectedException        \Cryptoprocessing\ApiException
     * @expectedExceptionMessage User already exists. Please Log in.
     */
    public function testRegister()
    {
        $user = \Cryptoprocessing\Authentication::register(self::$email, self::$password);
    }

    public function testLogin()
    {
        $user = \Cryptoprocessing\Authentication::login(self::$email, self::$password);

        $this->assertEquals('Successfully logged in.', $user->message);
        $this->assertEquals(self::$userId, $user->user_id);
        $this->assertEquals('success', $user->status);

        self::$authToken = $user->auth_token;
    }

    public function testAccountCreate()
    {
        $account = \Cryptoprocessing\Account::createAccount('test wallet');

        $this->assertEquals('test wallet', $account->name);
        $this->assertEquals('success', $account->status);
        $this->assertNotEmpty($account->account_id);
    }

    public function testGetAccountInfo()
    {
        $accountInfo = \Cryptoprocessing\Account::getAccountInfo(self::$accountId);

        $this->assertEquals('success', $accountInfo->status);
        $this->assertEquals(self::$accountId, $accountInfo->data->id);
    }

    public function testDefaultBlockChainType()
    {
        $blockChain = \Cryptoprocessing\Account::getBlockchaintype();

        $this->assertEquals('btc', $blockChain);
    }

    public function testAddAddress()
    {
        $address = \Cryptoprocessing\Address::addAddress(self::$accountId, 'test address name');

        $this->assertEquals('success', $address->status);
        $this->assertEquals('test address name', $address->name);
    }

    public function testAddressList()
    {
        $addressList = \Cryptoprocessing\Address::addressList(self::$accountId);

        $this->assertEquals('success', $addressList->status);
    }

    public function testShowAddress()
    {
        $address = \Cryptoprocessing\Address::showAddress(self::$accountId, self::$address);

        $this->assertEquals('success', $address->status);
        $this->assertEquals(self::$address, $address->address);
    }

    /**
     * @expectedException        \Cryptoprocessing\ApiException
     * @expectedExceptionMessage AttributeError('Attempt to add an already tracked address',)
     */
    public function testAddTrackingAddress()
    {
        $address = \Cryptoprocessing\Tracking::addTrAddress(self::$accountId, self::$address);
    }

    public function testTrackingAddressList()
    {
        $list = \Cryptoprocessing\Tracking::addressTrList(self::$accountId);

        $this->assertEquals('success', $list->status);
    }

    public function testTransactionsList()
    {
        $list = \Cryptoprocessing\Transaction::transactionsList(self::$accountId);

        $this->assertEquals('success', $list->status);
    }

    public function testTransactionsListByAddress()
    {
        $list = \Cryptoprocessing\Transaction::transactionsListByAddress(self::$accountId,self::$address);

        $this->assertTrue(is_array($list));
    }

    public function testCreateTransaction()
    {
        $transaction = \Cryptoprocessing\Transaction::createTransaction('9d740c98-b056-4dd0-82a3-3f86d4ba4a8e', array(
            'from' => array(
                'mjKzmFzg1rFkYNEbaCNzEhUsc5F16yTj6s'
            ),
            'to' =>
                array(
                    array('amount' => '100','address' => 'mx6xsCQ8AZNjic4FLu7mhTW4aFSXtFiVZT')
                ),
        ));

        $this->assertEquals('success', $transaction->status);
        $this->assertNotEmpty($transaction->transaction);
    }

    /**
     * @expectedException \Cryptoprocessing\ApiException
     */
    public function testCreateCallback()
    {
        $callback = \Cryptoprocessing\Callback::createCallback('9d740c98-b056-4dd0-82a3-3f86d4ba4a8e','http://test.ru');
    }

    public function testCallbackList()
    {
        $callback = \Cryptoprocessing\Callback::callbackList('9d740c98-b056-4dd0-82a3-3f86d4ba4a8e');

        $this->assertEquals('success', $callback->status);
    }
}