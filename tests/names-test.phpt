--TEST--
phpunit -c tests/_files/phpunit.xml tests/_files/PrinterNamesTest.php
--FILE--
<?php
$_SERVER['TERM']    = 'xterm';
$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = dirname(__FILE__).'/_files/phpunit.xml';
$_SERVER['argv'][3] = '--colors=always';
$_SERVER['argv'][4] = dirname(__FILE__).'/_files/PrinterNamesTest.php';

require_once(dirname(dirname(__FILE__))).'/vendor/autoload.php';

(new PHPUnit\TextUI\Application)->run($_SERVER['argv']);
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Runtime:       PHP %s
Configuration: %s

(1/8) [32m✔[0m [37mPrinterNamesTest: Test It Supports Camel Case[0m (%d ms)
(2/8) [32m✔[0m [37mPrinterNamesTest: Test It Supports Camel Case With CAPS Parts[0m (%d ms)
(3/8) [32m✔[0m [37mPrinterNamesTest: It supports snake case[0m (%d ms)
(4/8) [32m✔[0m [37mPrinterNamesTest: Itworkswithoutspacesaswell[0m (%d ms)
(5/8) [32m✔[0m [37mPrinterNamesTest: Test Supports whatever Case[0m (%d ms)
(6/8) [32m✔[0m [37mPrinterNamesTest: It Supports Data Provider with data set #0[0m (%d ms)
(7/8) [31m✖[0m [31mPrinterNamesTest: It Supports Data Provider with data set #1[0m (%d ms)
(8/8) [32m✔[0m [37mPrinterNamesTest: It Supports Data Provider with data set "named"[0m (%d ms)

Time: %s, Memory: %s MB

There was 1 failure:

1) PrinterNamesTest::itSupportsDataProvider%s
Failed asserting that false is true.

%sPrinterNamesTest.php:39

[37;41mFAILURES![0m
[37;41mTests: 8[0m[37;41m, Assertions: 8[0m[37;41m, Failures: 1[0m[37;41m.[0m
