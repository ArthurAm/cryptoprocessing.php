<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 23.02.18
 * Time: 20:48
 */

namespace Cryptoprocessing;


class Config
{
    private static $apiServerUrl = 'http://13.80.23.30';

    public static function getApiServerUrl() {
        return self::$apiServerUrl;
    }
}