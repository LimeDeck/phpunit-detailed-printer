<?php

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;

class PrinterNamesTest extends PHPUnit\Framework\TestCase
{
    public function testItSupportsCamelCase()
    {
        $this->assertTrue(true);
    }

    public function testItSupportsCamelCaseWithCAPSParts()
    {
        $this->assertTrue(true);
    }

    #[Test]
    public function it_supports_snake_case()
    {
        $this->assertTrue(true);
    }

    #[Test]
    public function itworkswithoutspacesaswell()
    {
        $this->assertTrue(true);
    }

    public function test_Supports_whateverCase()
    {
        $this->assertTrue(true);
    }

    #[Test]
    #[DataProvider('dataSetExamples')]
    public function itSupportsDataProvider($a, $b, $expected)
    {
        $this->assertTrue($expected);
    }

    public static function dataSetExamples()
    {
        return [
            ['a', 'b', true],
            [1, [1, 2], false],
            'named' => ['a', 'b', true],
        ];
    }
}
