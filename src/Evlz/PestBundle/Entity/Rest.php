<?php

/**
 * Created by PhpStorm.
 * User: hanov
 * Date: 29.01.14
 * Time: 18:18
 */

namespace Evlz\PestBundle\Entity;

class Rest
{

    /**
     * @var \Pest|\PestJSON $client;
     */

    protected $client;

    /**
     * @param $baseUrl
     * @param string $type
     * @return null|\Pest|\PestJSON
     */

    public function createClient($baseUrl, $type = Factory::TYPE_JSON, $forced = false)
    {
        if(!isset($this->client) || $forced)
        {
            $this->client = Factory::getClient($baseUrl, $type);
        }

        return $this->client;
    }
}