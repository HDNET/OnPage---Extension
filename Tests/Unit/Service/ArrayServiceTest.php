<?php


namespace HDNET\OnpageIntegration\Tests\Unit\Service;

use HDNET\OnpageIntegration\Service\ArrayService;
use TYPO3\CMS\Core\Tests\UnitTestCase;

/**
 *
 */
class ArrayServiceTest extends UnitTestCase
{

    /**
     * @test
     */
    public function testReplaceEmptyArray()
    {
        $service = new ArrayService();

        $array = [

        ];
        $replaceItem = 'Hallo Welt';
        $replaceKey = 'test';
        $expected = [];
        $this->assertSame($expected, $service->replaceRecursiveByKey($array, $replaceItem, $replaceKey));
    }

    /**
     * @test
     */
    public function testReplaceByKey()
    {
        $service = new ArrayService();

        $array = [
            'wert1' => 'Element',
            'test'  => 'old',
        ];
        $replaceItem = 'Hallo Welt';
        $replaceKey = 'test';
        $expected = [
            'wert1' => 'Element',
            'test'  => 'Hallo Welt',
        ];
        $this->assertSame($expected, $service->replaceRecursiveByKey($array, $replaceItem, $replaceKey));
    }

    /**
     * @test
     */
    public function testReplaceRecursiveByKey()
    {
        $service = new ArrayService();

        $array = [
            'wert1'  => 'Element',
            'test'   => 'old',
            'deeper' => [
                'test' => [
                    'nothing' => 99
                ],
            ],
        ];
        $replaceItem = 'Hallo Welt';
        $replaceKey = 'test';
        $expected = [
            'wert1'  => 'Element',
            'test'   => 'Hallo Welt',
            'deeper' => [
                'test' => 'Hallo Welt',
            ],
        ];
        $this->assertSame($expected, $service->replaceRecursiveByKey($array, $replaceItem, $replaceKey));
    }

    /**
     * @test
     */
    public function findElement()
    {
        $service = new ArrayService();

        $array = [
            'wert1'  => 'Element',
            'test'   => 'old',
            'deeper' => [
                'test' => [
                    'nothing' => 99
                ],
            ],
        ];
        $findElement = 'nothing';

        $this->assertSame(99, $service->findElement($array, $findElement));
    }
}
