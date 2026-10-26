--TEST--
phpunit -c tests/_files/phpunit.xml tests/_files/Unprepared
--FILE--
<?php
$_SERVER['TERM']    = 'xterm';
$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = dirname(__FILE__).'/_files/phpunit.xml';
$_SERVER['argv'][3] = '--colors=always';
$_SERVER['argv'][4] = dirname(__FILE__).'/_files/Unprepared';

define('PHPUNIT_COMPOSER_INSTALL', dirname(dirname(__FILE__)).'/vendor/autoload.php');
require_once PHPUNIT_COMPOSER_INSTALL;

(new PHPUnit\TextUI\Application)->run($_SERVER['argv']);
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Runtime:       PHP %s
Configuration: %s

(1/9) [31m![0m [31mBeforeClassErrorTest: Test First[0m
(2/9) [31m![0m [31mBeforeClassErrorTest: Test Second[0m
(3/9) [36mS[0m [36mBeforeClassSkipTest: Test First[0m
(4/9) [31m✖[0m [31mDependencyTest: Test Failure[0m (%d ms)
(5/9) [36mS[0m [36mDependencyTest: Test Depends On Failure[0m
(6/9) [31m![0m [31mIsolationCrashTest: Test Crash In Child Process[0m
(7/9) [36mS[0m [36mRequirementTest: Test Missing Extension[0m (%d ms)
(8/9) [32m✔[0m [37mRequirementTest: Test After Missing Extension[0m (%d ms)
(9/9) [31m![0m [31mSetUpErrorTest: Test Set Up Error[0m (%d ms)

Time: %s, Memory: %s MB

There were 3 errors:

1) BeforeClassErrorTest
RuntimeException: Before class

%sUnprepared/BeforeClassErrorTest.php:7

2) IsolationCrashTest::testCrashInChildProcess
Test was run in child process and ended unexpectedly

3) SetUpErrorTest::testSetUpError
RuntimeException: Set up

%sUnprepared/SetUpErrorTest.php:7

--

There was 1 failure:

1) DependencyTest::testFailure
Failed asserting that false is true.

%sUnprepared/DependencyTest.php:9

[37;41mERRORS![0m
[37;41mTests: %d[0m[37;41m, Assertions: 2[0m[37;41m, Errors: 3[0m[37;41m, Failures: 1[0m[37;41m, Skipped: 3[0m[37;41m.[0m
