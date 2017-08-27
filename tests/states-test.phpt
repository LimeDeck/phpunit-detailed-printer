--TEST--
phpunit -c tests/_files/phpunit.xml tests/_files/PrinterStatesTest.php
--FILE--
<?php
$_SERVER['TERM']    = 'xterm';
$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = dirname(__FILE__) . '/_files/phpunit.xml';
$_SERVER['argv'][3] = '--colors=always';
$_SERVER['argv'][4] = dirname(__FILE__) . '/_files/PrinterStatesTest.php';

require_once (dirname(dirname(__FILE__))) . '/vendor/autoload.php';

PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

[32m✔[0m [37mPrinterStatesTest: Test Success[0m (%s ms)
[31m✖[0m [31mPrinterStatesTest: Test Failure[0m (%s ms)
[31m![0m [31mPrinterStatesTest: Test Error[0m (%s ms)
[36mS[0m [36mPrinterStatesTest: Test Skipped[0m (%s ms)
[33mW[0m [33mPrinterStatesTest: Test Warning[0m (%s ms)
[33mR[0m [33mPrinterStatesTest: Test Risky[0m (%s ms)
[33mI[0m [33mPrinterStatesTest: Test Incomplete[0m (%s ms)


Time: %s, Memory: %sMB

There was 1 error:

1) PrinterStatesTest::testError
strpos() expects at least 2 parameters, 0 given

%sPrinterStatesTest.php:17

--

There was 1 warning:

1) PrinterStatesTest::testWarning

%sPrinterStatesTest.php:27

--

There was 1 failure:

1) PrinterStatesTest::testFailure
Failed asserting that false is true.

%sPrinterStatesTest.php:12

[37;41mERRORS![0m
[37;41mTests: 7[0m[37;41m, Assertions: 2[0m[37;41m, Errors: 1[0m[37;41m, Failures: 1[0m[37;41m, Warnings: 1[0m[37;41m, Skipped: 1[0m[37;41m, Incomplete: 1[0m[37;41m, Risky: 1[0m[37;41m.[0m
