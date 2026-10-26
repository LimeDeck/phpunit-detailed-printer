<?php

class BeforeClassErrorTest extends PHPUnit\Framework\TestCase
{
    public static function setUpBeforeClass(): void
    {
        throw new RuntimeException('Before class');
    }

    public function testFirst()
    {
        $this->assertTrue(true);
    }

    public function testSecond()
    {
        $this->assertTrue(true);
    }
}
