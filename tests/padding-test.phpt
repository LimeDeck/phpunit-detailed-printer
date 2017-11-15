--TEST--
phpunit -c tests/_files/phpunit.xml tests/_files/PrinterPaddingTest.php
--FILE--
<?php
$_SERVER['TERM']    = 'xterm';
$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = dirname(__FILE__) . '/_files/phpunit.xml';
$_SERVER['argv'][3] = '--colors=always';
$_SERVER['argv'][4] = dirname(__FILE__) . '/_files/PrinterPaddingTest.php';

require_once (dirname(dirname(__FILE__))) . '/vendor/autoload.php';

PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

( 1/12) [32m✔[0m [37mPrinterPaddingTest: Test1[0m (%s ms)
( 2/12) [32m✔[0m [37mPrinterPaddingTest: Test2[0m (%s ms)
( 3/12) [32m✔[0m [37mPrinterPaddingTest: Test3[0m (%s ms)
( 4/12) [32m✔[0m [37mPrinterPaddingTest: Test4[0m (%s ms)
( 5/12) [32m✔[0m [37mPrinterPaddingTest: Test5[0m (%s ms)
( 6/12) [32m✔[0m [37mPrinterPaddingTest: Test6[0m (%s ms)
( 7/12) [32m✔[0m [37mPrinterPaddingTest: Test7[0m (%s ms)
( 8/12) [32m✔[0m [37mPrinterPaddingTest: Test8[0m (%s ms)
( 9/12) [32m✔[0m [37mPrinterPaddingTest: Test9[0m (%s ms)
(10/12) [32m✔[0m [37mPrinterPaddingTest: Test10[0m (%s ms)
(11/12) [32m✔[0m [37mPrinterPaddingTest: Test11[0m (%s ms)
(12/12) [32m✔[0m [37mPrinterPaddingTest: Test12[0m (%s ms)


Time: %s, Memory: %sMB

[30;42mOK (12 tests, 12 assertions)[0m
