<?php

class PrinterDurationTest extends PHPUnit_Framework_TestCase
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
