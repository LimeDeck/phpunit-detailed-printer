<?php

namespace LimeDeck\Testing;

use PHPUnit_Extensions_PhptTestCase;
use PHPUnit_Framework_AssertionFailedError;
use PHPUnit_Framework_Test;
use PHPUnit_Framework_TestCase;
use PHPUnit_TextUI_ResultPrinter;
use PHPUnit_Util_Test;

class Printer extends PHPUnit_TextUI_ResultPrinter
{
    /**
     * Replacement symbols for test statuses.
     *
     * @var array
     */
    protected static $symbols = [
        'E' => '!',
        'F' => "\e[31m\xe2\x9c\x96\e[0m", // red X,
        '.' => "\e[32m\xe2\x9c\x94\e[0m", // green checkmark
    ];

    /**
     * Structure of the outputted test row.
     *
     * @var string
     */
    protected $testRow = '';

    /**
     * {@inheritdoc}
     */
    protected function writeProgress($progress)
    {
        if ($this->hasReplacementSymbol($progress)) {
            $progress = static::$symbols[$progress];
        }

        $this->write(sprintf('%s %s', $progress, $this->testRow));
        $this->column++;
        $this->numTestsRun++;
    }

    /**
     * A failure occurred.
     *
     * @param PHPUnit_Framework_Test                 $test
     * @param PHPUnit_Framework_AssertionFailedError $e
     * @param float                                  $time
     */
    public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time)
    {
        // TODO: this is not very nice :/
        $this->buildTestRow("\e[31m".get_class($test), $test->getName()."\e[0m", $time);
        $this->writeProgress('F');
        $this->lastTestFailed = true;
    }

    /**
     * {@inheritdoc}
     */
    public function endTest(PHPUnit_Framework_Test $test, $time)
    {
        $testName = PHPUnit_Util_Test::describe($test);

        if (!empty($testName)) {
            list($className, $methodName) = explode('::', $testName);

            $this->buildTestRow($className, $methodName, $time);
        }

        if (!$this->lastTestFailed) {
            $this->writeProgress('.');
        }

        if ($test instanceof PHPUnit_Framework_TestCase) {
            $this->numAssertions += $test->getNumAssertions();
        } elseif ($test instanceof PHPUnit_Extensions_PhptTestCase) {
            $this->numAssertions++;
        }
        
        $this->lastTestFailed = false;

        if ($test instanceof PHPUnit_Framework_TestCase) {
            if (method_exists($this, 'hasExpectationOnOutput') && !$test->hasExpectationOnOutput()) {
                $this->write($test->getActualOutput());
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function writeProgressWithColor($color, $buffer)
    {
        return $this->writeProgress($buffer);
    }

    /**
     * @param $className
     * @param $methodName
     * @param $time
     */
    private function buildTestRow($className, $methodName, $time)
    {
        $testDuration = round($time * 1000);

        $this->testRow = sprintf(
            "%s: %s (%s ms)\n",
            $className,
            preg_replace('/(?<=\\w)(?=[A-Z])/', ' $1', ucfirst(str_replace('_', ' ', $methodName))),
            $testDuration > 500 ? "\e[33m{$testDuration}\e[0m" : $testDuration
        );
    }

    /**
     * @param $progress
     * @return bool
     */
    protected function hasReplacementSymbol($progress)
    {
        return in_array($progress, array_keys(static::$symbols));
    }
}
