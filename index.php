<?php

require_once 'vendor/autoload.php';


$user = \Cryptoprocessing\Authentication::login('phptest@test.com','123321');

$callback = \Cryptoprocessing\Request::setApiServerUrl('test');

echo '<pre>';
var_dump($callback);
echo '</pre>';