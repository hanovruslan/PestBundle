<?php

/**
 * Created by PhpStorm.
 * User: hanov
 * Date: 29.01.14
 * Time: 19:45
 */

use Evlz\PestBundle\Entity\JSONRestClient;

require_once __DIR__ . '/../vendor/autoload.php';

$endpoints = [
    'twitter' => [
        'domain' => 'https://api.twitter.com',
        'uri' => '/1.1/help/configuration.json',
    ],
    'youtube' => [
        'domain' => 'http://gdata.youtube.com',
        'uri' => '/feeds/api/videos?alt=json&v=2&safeSearch=none&time=all_time&uploader=partner',
    ],
];

foreach($endpoints as $endpoint){
    try{
        $restClient = new JSONRestClient($endpoint['domain']);
        $result = $restClient->get($endpoint['uri']);
        echo PHP_EOL,print_r([$result['version']], true),PHP_EOL;
    }
    catch(\Exception $e){
        echo PHP_EOL,'Caught exception \'' . get_class($e) . '\': ' . $e->getMessage(),PHP_EOL;
    }
}