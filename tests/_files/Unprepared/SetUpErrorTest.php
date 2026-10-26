<?php

class SetUpErrorTest extends PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        throw new RuntimeException('Set up');
    }

    public function testSetUpError()
    {
        $this->assertTrue(true);
    }
}
