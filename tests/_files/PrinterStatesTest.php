<?php

class PrinterStatesTest extends PHPUnit\Framework\TestCase
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
        throw new PHPUnit\Framework\Warning();
    }

    public function testRisky()
    {
        throw new PHPUnit\Framework\RiskyTestError();
    }

    public function testIncomplete()
    {
        $this->markTestIncomplete('Incomplete');
    }
}
