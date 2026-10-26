<?php

use PHPUnit\Framework\Attributes\RequiresPhpExtension;

class RequirementTest extends PHPUnit\Framework\TestCase
{
    #[RequiresPhpExtension('limedeck_missing_extension')]
    public function testMissingExtension()
    {
        $this->assertTrue(true);
    }

    public function testAfterMissingExtension()
    {
        $this->assertTrue(true);
    }
}
