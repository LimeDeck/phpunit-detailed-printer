--TEST--
phpunit -c tests/_files/phpunit.xml --no-progress --colors=always tests/_files/PrinterPaddingTest.php
--FILE--
<?php
$_SERVER['TERM']    = 'xterm';
$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = dirname(__FILE__).'/_files/phpunit.xml';
$_SERVER['argv'][3] = '--no-progress';
$_SERVER['argv'][4] = '--colors=always';
$_SERVER['argv'][5] = dirname(__FILE__).'/_files/PrinterPaddingTest.php';

require_once(dirname(dirname(__FILE__))).'/vendor/autoload.php';

(new PHPUnit\TextUI\Application)->run($_SERVER['argv']);
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Runtime:       PHP %s
Configuration: %s

Time: %s, Memory: %s MB

[30;42mOK (12 tests, 12 assertions)[0m
