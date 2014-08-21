<?php

/**
 * Created by PhpStorm.
 * User: hanov
 * Date: 29.01.14
 * Time: 18:18
 */

namespace Evlz\PestBundle\Entity;

use Pest;
use PestJSON;

class Rest implements RestInterface
{

    /**
     * @var string
     */

    protected $baseUrl;

    /**
     * @var string
     */

    protected $type = Factory::TYPE_JSON;

    /**
     * @var Pest|PestJSON $client;
     */

    protected $client;

    /**
     * @param $baseUrl
     * @param string $type
     * @param boolean $forced
     * @return null|Pest|PestJSON
     */


    public function createClient($baseUrl, $type = Factory::TYPE_JSON, $forced = false)
    {
        if(!isset($this->client) || $forced)
        {
            $this->client = Factory::getClient($baseUrl, $type);
        }

        return $this->client;
    }

    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function buildClient($forced = true)
    {
        return $this->createClient($this->getBaseUrl(), $this->getType(), $forced);
    }
}