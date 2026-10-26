--TEST--
phpunit -c tests/_files/phpunit.xml --colors=never tests/_files/PrinterStatesTest.php
--FILE--
<?php
$_SERVER['TERM']    = 'xterm';
$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = dirname(__FILE__).'/_files/phpunit.xml';
$_SERVER['argv'][3] = '--colors=never';
$_SERVER['argv'][4] = dirname(__FILE__).'/_files/PrinterStatesTest.php';

require_once(dirname(dirname(__FILE__))).'/vendor/autoload.php';

(new PHPUnit\TextUI\Application)->run($_SERVER['argv']);
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Runtime:       PHP %s
Configuration: %s

( 1/11) . PrinterStatesTest: Test Success (%d ms)
( 2/11) F PrinterStatesTest: Test Failure (%d ms)
( 3/11) E PrinterStatesTest: Test Error (%d ms)
( 4/11) S PrinterStatesTest: Test Skipped (%d ms)
( 5/11) W PrinterStatesTest: Test Warning (%d ms)
( 6/11) N PrinterStatesTest: Test Notice (%d ms)
( 7/11) D PrinterStatesTest: Test Deprecation (%d ms)
( 8/11) R PrinterStatesTest: Test Risky (%d ms)
( 9/11) I PrinterStatesTest: Test Incomplete (%d ms)
(10/11) W PrinterStatesTest: Test Most Severe Issue Wins (%d ms)
(11/11) . PrinterStatesTest: Test Suppressed Deprecation (%d ms)

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

ERRORS!
Tests: 11, Assertions: 7, Errors: 1, Failures: 1, Warnings: 2, Deprecations: 2, Notices: 2, Skipped: 1, Incomplete: 1, Risky: 1.
