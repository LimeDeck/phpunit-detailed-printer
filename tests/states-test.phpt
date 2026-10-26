--TEST--
phpunit -c tests/_files/phpunit.xml tests/_files/PrinterStatesTest.php
--FILE--
<?php
$_SERVER['TERM']    = 'xterm';
$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = dirname(__FILE__).'/_files/phpunit.xml';
$_SERVER['argv'][3] = '--colors=always';
$_SERVER['argv'][4] = dirname(__FILE__).'/_files/PrinterStatesTest.php';

require_once(dirname(dirname(__FILE__))).'/vendor/autoload.php';

(new PHPUnit\TextUI\Application)->run($_SERVER['argv']);
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Runtime:       PHP %s
Configuration: %s

( 1/11) [32m✔[0m [37mPrinterStatesTest: Test Success[0m (%d ms)
( 2/11) [31m✖[0m [31mPrinterStatesTest: Test Failure[0m (%d ms)
( 3/11) [31m![0m [31mPrinterStatesTest: Test Error[0m (%d ms)
( 4/11) [36mS[0m [36mPrinterStatesTest: Test Skipped[0m (%d ms)
( 5/11) [33mW[0m [33mPrinterStatesTest: Test Warning[0m (%d ms)
( 6/11) [33mN[0m [33mPrinterStatesTest: Test Notice[0m (%d ms)
( 7/11) [33mD[0m [33mPrinterStatesTest: Test Deprecation[0m (%d ms)
( 8/11) [33mR[0m [33mPrinterStatesTest: Test Risky[0m (%d ms)
( 9/11) [33mI[0m [33mPrinterStatesTest: Test Incomplete[0m (%d ms)
(10/11) [33mW[0m [33mPrinterStatesTest: Test Most Severe Issue Wins[0m (%d ms)
(11/11) [32m✔[0m [37mPrinterStatesTest: Test Suppressed Deprecation[0m (%d ms)

Time: %s, Memory: %s MB

There was 1 error:

1) PrinterStatesTest::testError
RuntimeException: Error

%sPrinterStatesTest.php:17

--

There was 1 failure:

1) PrinterStatesTest::testFailure
Failed asserting that false is true.

%sPrinterStatesTest.php:12

--

There was 1 risky test:

1) PrinterStatesTest::testRisky
This test did not perform any assertions

%sPrinterStatesTest.php:43

[37;41mERRORS![0m
[37;41mTests: 11[0m[37;41m, Assertions: 7[0m[37;41m, Errors: 1[0m[37;41m, Failures: 1[0m[37;41m, Warnings: 2[0m[37;41m, Deprecations: 2[0m[37;41m, Notices: 2[0m[37;41m, Skipped: 1[0m[37;41m, Incomplete: 1[0m[37;41m, Risky: 1[0m[37;41m.[0m
