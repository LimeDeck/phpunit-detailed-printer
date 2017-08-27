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

[32m✔[0m [37mPrinterNamesTest: Test It Supports Camel Case[0m (%s ms)
[32m✔[0m [37mPrinterNamesTest: Test It Supports Camel Case With CAPS Parts[0m (%s ms)
[32m✔[0m [37mPrinterNamesTest: It supports snake case[0m (%s ms)
[32m✔[0m [37mPrinterNamesTest: Itworkswithoutspacesaswell[0m (%s ms)
[32m✔[0m [37mPrinterNamesTest: Test Supports whatever Case[0m (%s ms)


Time: %s, Memory: %sMB

[30;42mOK (5 tests, 5 assertions)[0m
