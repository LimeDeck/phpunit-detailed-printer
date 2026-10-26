<?php

use PHPUnit\Framework\Attributes\Depends;

class DependencyTest extends PHPUnit\Framework\TestCase
{
    public function testFailure()
    {
        $this->assertTrue(false);
    }

    #[Depends('testFailure')]
    public function testDependsOnFailure()
    {
        $this->assertTrue(true);
    }
}
