--TEST--
phpunit -c tests/_files/phpunit.xml tests/_files/PrinterNamesTest.php
--FILE--
<?php
$_SERVER['TERM']    = 'xterm';
$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = dirname(__FILE__) . '/_files/phpunit.xml';
$_SERVER['argv'][3] = '--colors=always';
$_SERVER['argv'][4] = dirname(__FILE__) . '/_files/PrinterNamesTest.php';

require_once (dirname(dirname(__FILE__))) . '/vendor/autoload.php';

PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

(1/7) [32m✔[0m [37mPrinterNamesTest: Test It Supports Camel Case[0m (%s ms)
(2/7) [32m✔[0m [37mPrinterNamesTest: Test It Supports Camel Case With CAPS Parts[0m (%s ms)
(3/7) [32m✔[0m [37mPrinterNamesTest: It supports snake case[0m (%s ms)
(4/7) [32m✔[0m [37mPrinterNamesTest: Itworkswithoutspacesaswell[0m (%s ms)
(5/7) [32m✔[0m [37mPrinterNamesTest: Test Supports whatever Case[0m (%s ms)
(6/7) [32m✔[0m [37mPrinterNamesTest: It Supports Data Provider with data set #0 ('a', 'b', true)[0m (%s ms)
(7/7) [31m✖[0m [31mPrinterNamesTest: It Supports Data Provider with data set #1[0m (%s ms)


Time: %s, Memory: %sMB

There was 1 failure:

1) PrinterNamesTest::itSupportsDataProvider with data set #1 (1, array(1, 2), false)
Failed asserting that false is true.

%s/phpunit-detailed-printer/tests/_files/PrinterNamesTest.php:38

[37;41mFAILURES![0m
[37;41mTests: 7[0m[37;41m, Assertions: 7[0m[37;41m, Failures: 1[0m[37;41m.[0m

