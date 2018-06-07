<?php

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

    /** @test */
    public function it_supports_snake_case()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function itworkswithoutspacesaswell()
    {
        $this->assertTrue(true);
    }

    public function test_Supports_whateverCase()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     * @dataProvider dataSetExamples
     */
    public function itSupportsDataProvider($a, $b, $expected)
    {
        $this->assertTrue($expected);
    }

    public function dataSetExamples()
    {
        return [
            ['a', 'b', true],
            [1, [1, 2], false],
        ];
    }
}
