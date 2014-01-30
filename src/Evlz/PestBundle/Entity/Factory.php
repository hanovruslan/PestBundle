<?php

/**
 * Created by PhpStorm.
 * User: hanov
 * Date: 30.01.14
 * Time: 10:24
 */

namespace Evlz\PestBundle\Entity;

class Factory
{

    const TYPE_MAIN = 'main';
    const TYPE_JSON = 'json';

    /**
     * @param $baseUrl
     * @param string $type
     * @return null|\Pest|\PestJSON
     */

    static public function getClient($baseUrl, $type = self::TYPE_JSON)
    {
        $result = null;
        switch($type)
        {
            case self::TYPE_MAIN:
            {
                $result = new \Pest($baseUrl);
                break;
            }
            case self::TYPE_JSON:
            {
                $result = new \PestJSON($baseUrl);
                break;
            }
        }

        return $result;
    }
} 