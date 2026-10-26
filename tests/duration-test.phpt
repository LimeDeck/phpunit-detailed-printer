--TEST--
phpunit -c tests/_files/phpunit.xml tests/_files/PrinterDurationTest.php
--FILE--
<?php
$_SERVER['TERM']    = 'xterm';
$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = dirname(__FILE__).'/_files/phpunit.xml';
$_SERVER['argv'][3] = '--colors=always';
$_SERVER['argv'][4] = dirname(__FILE__).'/_files/PrinterDurationTest.php';

require_once(dirname(dirname(__FILE__))).'/vendor/autoload.php';

(new PHPUnit\TextUI\Application)->run($_SERVER['argv']);
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Runtime:       PHP %s
Configuration: %s

(1/2) [32m✔[0m [37mPrinterDurationTest: Test Short[0m (%d ms)
(2/2) [32m✔[0m [37mPrinterDurationTest: Test Long[0m ([33m%d[0m ms)

Time: %s, Memory: %s MB

[30;42mOK (2 tests, 2 assertions)[0m
