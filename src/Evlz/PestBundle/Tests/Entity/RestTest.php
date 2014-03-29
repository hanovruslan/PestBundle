<?php

/**
 * Created by PhpStorm.
 * User: hanov
 * Date: 29.03.14
 * Time: 16:08
 */

namespace Evlz\PestBundle\Tests\Entity;

use Pest;
use PestJSON;

use PHPUnit_Framework_TestCase;

use Evlz\PestBundle\Entity\Factory;
use Evlz\PestBundle\Entity\Rest;
use Evlz\PestBundle\Entity\RestInterface;

class RestTest  extends PHPUnit_Framework_TestCase
{

    /**
     * @var Rest
     */

    public $rest;

    public function setUp()
    {
        require_once __DIR__ . '/../../../../../vendor/autoload.php';
        $this->rest = new Rest();
    }

    public function testInterface()
    {
        $this->assertTrue($this->rest instanceof RestInterface);
    }

    public function testClientTypeMain()
    {
        $client = $this->rest
            ->createClient('/hello/test', Factory::TYPE_MAIN);
        $this->assertFalse($client instanceof PestJSON);
        $this->assertTrue($client instanceof Pest);
    }

    public function testClientTypeJson()
    {
        $client = $this->rest
            ->createClient('/hello/test', Factory::TYPE_JSON);
        $this->assertTrue($client instanceof PestJSON);
    }
}
