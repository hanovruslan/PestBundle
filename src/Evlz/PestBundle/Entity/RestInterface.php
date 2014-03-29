<?php

/**
 * Created by PhpStorm.
 * User: hanov
 * Date: 29.03.14
 * Time: 15:35
 */

namespace Evlz\PestBundle\Entity;


interface RestInterface
{

    public function createClient($baseUrl, $type = Factory::TYPE_JSON, $forced = false);

} 