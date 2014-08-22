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

use Evlz\PestBundle\Component\DataConverter;

class DataConverterTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var DataConverter
     */

    protected $converter;

    protected $scalarData;
    protected $garbageData;

    public function setUp()
    {
        require_once __DIR__ . '/../../../../../vendor/autoload.php';
        $this->converter = new DataConverter();
        $this->scalarData = [
            'start',
            1,
            '2' => 'value',
            3 => 2,
            'float' => 2.3,
            'float_string' => (float) '2.3',
        ];
        $this->garbageData = [
            new stdClass(),
        ];
    }

    public function testPlainDataConversion()
    {
        $from = $this->scalarData;
        $to =  $this->scalarData;
        $this->assertTrue(json_encode($this->converter->convert($from)) == json_encode($to));
    }

    public function testOneLevelDataConversion()
    {
        $from = [
            'a' => $this->scalarData,
        ];
        $to = [
            'a[0]' => $this->scalarData[0],
            'a[1]' => $this->scalarData[1],
            'a[2]' => $this->scalarData[2],
            'a[3]' => $this->scalarData[3],
            'a[float]' => $this->scalarData['float'],
            'a[float_string]' => $this->scalarData['float_string'],
        ];
        $this->assertTrue(json_encode($this->converter->convert($from)) == json_encode($to));
    }

    public function testTwoLevelDataConversion()
    {
        $from = [
            'a' => [
                'b' => $this->scalarData,
            ],
        ];
        $to = [
            'a[b][0]' => $this->scalarData[0],
            'a[b][1]' => $this->scalarData[1],
            'a[b][2]' => $this->scalarData[2],
            'a[b][3]' => $this->scalarData[3],
            'a[b][float]' => $this->scalarData['float'],
            'a[b][float_string]' => $this->scalarData['float_string'],
        ];

        $this->assertTrue(json_encode($this->converter->convert($from)) == json_encode($to));
    }

    public function testThreeLevelDataConversion()
    {
        $from = [
            'a' => [
                'b' => [
                    'c' => $this->scalarData,
                ],
            ],
        ];

        $to = [
            'a[b][c][0]' => $this->scalarData[0],
            'a[b][c][1]' => $this->scalarData[1],
            'a[b][c][2]' => $this->scalarData[2],
            'a[b][c][3]' => $this->scalarData[3],
            'a[b][c][float]' => $this->scalarData['float'],
            'a[b][c][float_string]' => $this->scalarData['float_string'],
        ];

        $this->assertTrue(json_encode($this->converter->convert($from)) == json_encode($to));
    }

    public function testThreeComplexLevelDataConversion()
    {
        $from = [
            'a',
            'b' => [
                'c' => $this->scalarData,
            ],
            'd',
            'e' => [
                'f' => [
                    'g' => $this->scalarData,
                ],
            ],
        ];

        $to = [
            0 => 'a',
            'b[c][0]' => $this->scalarData[0],
            'b[c][1]' => $this->scalarData[1],
            'b[c][2]' => $this->scalarData[2],
            'b[c][3]' => $this->scalarData[3],
            'b[c][float]' => $this->scalarData['float'],
            'b[c][float_string]' => $this->scalarData['float_string'],
            1 => 'd',
            'e[f][g][0]' => $this->scalarData[0],
            'e[f][g][1]' => $this->scalarData[1],
            'e[f][g][2]' => $this->scalarData[2],
            'e[f][g][3]' => $this->scalarData[3],
            'e[f][g][float]' => $this->scalarData['float'],
            'e[f][g][float_string]' => $this->scalarData['float_string'],

        ];

        $this->assertTrue(json_encode($this->converter->convert($from)) == json_encode($to));
    }

    public function testGarbageConversion()
    {
        foreach($this->garbageData as $key => $value)
        {
            $to = $from = $value;
            $this->assertFalse(json_encode($this->converter->convert($from)) == json_encode($to));
        }
    }

}
