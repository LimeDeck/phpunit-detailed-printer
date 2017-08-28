<?php

class PrinterDurationTest extends PHPUnit\Framework\TestCase
{
    public function testShort()
    {
        $this->assertTrue(true);
    }

    public function testLong()
    {
        usleep(600000);
        $this->assertTrue(true);
    }
}
