--TEST--
phpunit -c tests/_files/phpunit.xml --colors=always tests/_files/PrinterPhptTest.phpt
--FILE--
<?php
$_SERVER['TERM']    = 'xterm';
$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = dirname(__FILE__).'/_files/phpunit.xml';
$_SERVER['argv'][3] = '--colors=always';
$_SERVER['argv'][4] = dirname(__FILE__).'/_files/PrinterPhptTest.phpt';

require_once(dirname(dirname(__FILE__))).'/vendor/autoload.php';

(new PHPUnit\TextUI\Application)->run($_SERVER['argv']);
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Runtime:       PHP %s
Configuration: %s

(1/1) [32m✔[0m [37m%sPrinterPhptTest.phpt[0m (%d ms)

Time: %s, Memory: %s MB

[30;42mOK (1 test, 1 assertion)[0m
