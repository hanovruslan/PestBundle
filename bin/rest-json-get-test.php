<?php

/**
 * Created by PhpStorm.
 * User: hanov
 * Date: 29.01.14
 * Time: 19:45
 */

use Evlz\PestBundle\Entity\Rest;

require_once __DIR__ . '/../vendor/autoload.php';

$endpoints = [
    'twitter' => [
        'baseUrl' => 'https://api.twitter.com',
        'url' => '/1.1/help/configuration.json',
    ],
    'youtube' => [
        'baseUrl' => 'http://api.wunderground.com',
        'url' => '/api/key/geolookup/q/CA/San_Francisco.json',
    ],
];

foreach($endpoints as $endpoint){
    try{
        $rest = new Rest();
        $restClient = $rest->createClient($endpoint['baseUrl']);
        $result = $restClient->get($endpoint['url']);
        echo PHP_EOL,print_r([$result], true),PHP_EOL;
    }
    catch(\Exception $e){
        echo PHP_EOL,'Caught exception \'' . get_class($e) . '\': ' . $e->getMessage(),PHP_EOL;
    }
}