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
        throw new RuntimeException('Error');
    }

    public function testSkipped()
    {
        $this->markTestSkipped('Skipped');
    }

    public function testWarning()
    {
        trigger_error('Warning', E_USER_WARNING);
        $this->assertTrue(true);
    }

    public function testNotice()
    {
        trigger_error('Notice', E_USER_NOTICE);
        $this->assertTrue(true);
    }

    public function testDeprecation()
    {
        trigger_error('Deprecation', E_USER_DEPRECATED);
        $this->assertTrue(true);
    }

    public function testRisky()
    {
    }

    public function testIncomplete()
    {
        $this->markTestIncomplete('Incomplete');
    }

    public function testMostSevereIssueWins()
    {
        trigger_error('Notice', E_USER_NOTICE);
        trigger_error('Warning', E_USER_WARNING);
        trigger_error('Deprecation', E_USER_DEPRECATED);
        $this->assertTrue(true);
    }

    public function testSuppressedDeprecation()
    {
        @trigger_error('Deprecation', E_USER_DEPRECATED);
        $this->assertTrue(true);
    }
}
