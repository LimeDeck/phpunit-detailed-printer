<?php

class BeforeClassSkipTest extends PHPUnit\Framework\TestCase
{
    public static function setUpBeforeClass(): void
    {
        self::markTestSkipped('Before class');
    }

    public function testFirst()
    {
        $this->assertTrue(true);
    }
}
