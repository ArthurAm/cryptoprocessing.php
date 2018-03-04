# Cryptoprocessing

PHP package to access and interact with [Cryptoprocessing API](https://api.cryptoprocessing.io).

[![Build Status](https://travis-ci.org/oomag/cryptoprocessing.php.svg?branch=master)](https://travis-ci.org/oomag/cryptoprocessing.php)

## Installation

You can install this package via [Composer](http://getcomposer.org).

```bash
composer require oomag/cryptoprocessing
composer update
```


## Usage

```php
//Register new user
$user = Cryptoprocessing\Authentication::register($email,$password);

//Send transaction to different addresses
$transaction = Cryptoprocessing\Transaction::createTransaction($accountId, array(
            'from' => [
                $mainAddress, $testAddress
            ],
            'to' =>
                [
                    array('amount' => '100','address' => $firstAddress),
                    array('amount' => '100','address' => $secondAddress)
                ],
        ));


```

## License

The package is available as open source under the terms of the [MIT License](https://opensource.org/licenses/MIT).