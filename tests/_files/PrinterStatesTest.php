<?php

class PrinterStatesTest extends PHPUnit_Framework_TestCase
{
    public function testSuccess()
    {
        $this->assertTrue(true);
    }

    public function testFailure()
    {
        $this->assertTrue(false);
    }

    public function testError()
    {
        strpos();
    }

    public function testSkipped()
    {
        $this->markTestSkipped('Skipped');
    }

    public function testWarning()
    {
        throw new PHPUnit_Framework_Warning();
    }

    public function testRisky()
    {
        throw new PHPUnit_Framework_RiskyTestError();
    }

    public function testIncomplete()
    {
        $this->markTestIncomplete('Incomplete');
    }
}
