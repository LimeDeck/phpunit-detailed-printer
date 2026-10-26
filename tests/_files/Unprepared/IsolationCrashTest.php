<?php

use PHPUnit\Framework\Attributes\RunInSeparateProcess;

class IsolationCrashTest extends PHPUnit\Framework\TestCase
{
    #[RunInSeparateProcess]
    public function testCrashInChildProcess()
    {
        exit(1);
    }
}
