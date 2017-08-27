--TEST--
phpunit -c tests/_files/phpunit.xml tests/_files/PrinterDurationTest.php
--FILE--
<?php
$_SERVER['TERM']    = 'xterm';
$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = dirname(__FILE__) . '/_files/phpunit.xml';
$_SERVER['argv'][3] = '--colors=always';
$_SERVER['argv'][4] = dirname(__FILE__) . '/_files/PrinterDurationTest.php';

require_once (dirname(dirname(__FILE__))) . '/vendor/autoload.php';

PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

[32m✔[0m [37mPrinterDurationTest: Test Short[0m (%s ms)
[32m✔[0m [37mPrinterDurationTest: Test Long[0m ([33m%s[0m ms)


Time: %s, Memory: %sMB

[30;42mOK (2 tests, 2 assertions)[0m
