--TEST--
phpunit -c tests/_files/phpunit.xml tests/_files/PrinterStatesTest.php
--FILE--
<?php
$_SERVER['TERM']    = 'xterm';
$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = dirname(__FILE__) . '/_files/phpunit.xml';
$_SERVER['argv'][3] = '--filter';
$_SERVER['argv'][4] = 'notests';
$_SERVER['argv'][6] = '--colors=always';
$_SERVER['argv'][7] = dirname(__FILE__) . '/_files/PrinterStatesTest.php';

require_once (dirname(dirname(__FILE__))) . '/vendor/autoload.php';

PHPUnit_TextUI_Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.



Time: %s, Memory: %sMB

[30;43mNo tests executed![0m
