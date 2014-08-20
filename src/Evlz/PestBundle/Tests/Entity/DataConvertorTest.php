<?php
/**
 * Created by PhpStorm.
 * User: rh
 * Date: 20.08.14
 * Time: 12:49
 */

namespace Evlz\PestBundle\Tests\Entity;

use PHPUnit_Framework_TestCase;

use stdClass;

use Evlz\PestBundle\Component\DataConvertor;

class DataConvertorTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var DataConvertor
     */

    protected $convertor;

    protected $plainPattern = [
        '1' => 'value',
        2 => 'other value',
        'c' => 'last text or string value value',
    ];

    public function setUp()
    {
        require_once __DIR__ . '/../../../../../vendor/autoload.php';
        $this->convertor = new DataConvertor();
    }

    public function testStringConvertion()
    {
        $from = $this->plainPattern['1'];

        $to = $from;

        $this->assertTrue(json_encode($this->convertor->convert($from)) == json_encode($to));
    }

    public function testUnsupportedConvertion()
    {
        $from = new stdClass;

        $to = null;

        $this->assertTrue(json_encode($this->convertor->convert($from)) == json_encode($to));
    }

    public function testPlainDataConvertion()
    {
        $from = $this->plainPattern;
        $to =  $this->plainPattern;
        $this->assertTrue(json_encode($this->convertor->convert($from)) == json_encode($to));
    }

    public function testOneLevelDataConvertion()
    {
        $from = [
            'x' => $this->plainPattern,
        ];

        $to = [
            'x[1]' => $this->plainPattern['1'],
            'x[2]' => $this->plainPattern[2],
            'x[c]' => $this->plainPattern['c'],
        ];
        $this->assertTrue(json_encode($this->convertor->convert($from)) == json_encode($to));
    }

    public function testTwoLevelDataConvertion()
    {
        $from = [
            'x' => [
                'y' => $this->plainPattern,
            ],
        ];

        $to = [
            'x[y][1]' => $this->plainPattern['1'],
            'x[y][2]' => $this->plainPattern[2],
            'x[y][c]' => $this->plainPattern['c'],
        ];

        $this->assertTrue(json_encode($this->convertor->convert($from)) == json_encode($to));
    }

    public function testThreeLevelDataConvertion()
    {
        $from = [
            'x' => [
                'y' => [
                    'z' => $this->plainPattern,
                ],
            ],
        ];

        $to = [
            'x[y][z][1]' => $this->plainPattern['1'],
            'x[y][z][2]' => $this->plainPattern[2],
            'x[y][z][c]' => $this->plainPattern['c'],
        ];

        $this->assertTrue(json_encode($this->convertor->convert($from)) == json_encode($to));
    }

    public function testThreeComplexLevelDataConvertion()
    {
        $from = [
            'x' => [
                'y' => [
                    'z' => $this->plainPattern,
                ],
            ],
            'c' => [
                'b' => [
                    'a' => [
                        'c' => $this->plainPattern['c'],
                        '2' => $this->plainPattern['2'],
                        '1' => $this->plainPattern['1'],
                    ],
                ],
            ],
        ];

        $to = [
            'x[y][z][1]' => $this->plainPattern['1'],
            'x[y][z][2]' => $this->plainPattern[2],
            'x[y][z][c]' => $this->plainPattern['c'],
            'c[b][a][c]' => $this->plainPattern['c'],
            'c[b][a][2]' => $this->plainPattern['2'],
            'c[b][a][1]' => $this->plainPattern['1'],
        ];

        $this->assertTrue(json_encode($this->convertor->convert($from)) == json_encode($to));
    }

}
