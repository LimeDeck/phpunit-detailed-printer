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
}
