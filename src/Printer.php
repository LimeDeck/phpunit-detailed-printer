<?php

namespace LimeDeck\Testing;

use PHPUnit\Event\Event;
use PHPUnit\Event\Code\Test;
use PHPUnit\Event\Test\Failed;
use PHPUnit\Event\Test\Errored;
use PHPUnit\Event\Test\Skipped;
use PHPUnit\Event\Test\Finished;
use PHPUnit\Event\Test\Prepared;
use PHPUnit\Event\Tracer\Tracer;
use PHPUnit\Event\Code\TestMethod;
use PHPUnit\Event\Telemetry\HRTime;
use PHPUnit\Event\Telemetry\Duration;
use PHPUnit\Event\Code\TestCollection;
use PHPUnit\Event\Test\ErrorTriggered;
use PHPUnit\Event\TestSuite\TestSuite;
use PHPUnit\Event\Test\ConsideredRisky;
use PHPUnit\Event\Test\NoticeTriggered;
use PHPUnit\Event\Test\MarkedIncomplete;
use PHPUnit\Event\Test\WarningTriggered;
use PHPUnit\TextUI\Configuration\Source;
use PHPUnit\Event\Test\PhpNoticeTriggered;
use PHPUnit\Event\Test\PreparationStarted;
use PHPUnit\Event\Test\PhpWarningTriggered;
use PHPUnit\Event\Test\DeprecationTriggered;
use PHPUnit\Event\Test\PhpunitNoticeTriggered;
use PHPUnit\Event\TestRunner\ExecutionStarted;
use PHPUnit\Event\Test\PhpDeprecationTriggered;
use PHPUnit\Event\Test\PhpunitWarningTriggered;
use PHPUnit\Event\TestRunner\ExecutionFinished;
use PHPUnit\Event\Test\BeforeFirstTestMethodFailed;
use PHPUnit\Event\Test\PhpunitDeprecationTriggered;
use PHPUnit\Event\Test\BeforeFirstTestMethodErrored;
use PHPUnit\Event\TestSuite\Skipped as TestSuiteSkipped;
use PHPUnit\Event\TestSuite\Started as TestSuiteStarted;

final class Printer implements Tracer
{
    private int $total = 0;
    private int $run   = 0;

    private ?Test $current                = null;
    private ?HRTime $startedAt            = null;
    private bool $prepared                = false;
    private Status $status                = Status::Passed;
    private ?TestCollection $testsOfClass = null;

    /**
     * @param resource $output
     */
    public function __construct(
        private $output,
        private readonly bool $colors,
        private readonly Source $source,
    ) {
    }

    public function trace(Event $event): void
    {
        match (true) {
            $event instanceof ExecutionStarted             => $this->total = $event->testSuite()->count(),
            $event instanceof TestSuiteStarted             => $this->testSuiteStarted($event->testSuite()),
            $event instanceof TestSuiteSkipped             => $this->printUnstarted($event->testSuite()->tests(), Status::Skipped),
            $event instanceof BeforeFirstTestMethodErrored => $this->printUnstartedTestsOfClass(Status::Errored),
            $event instanceof BeforeFirstTestMethodFailed  => $this->printUnstartedTestsOfClass(Status::Failed),
            $event instanceof PreparationStarted           => $this->start($event),
            $event instanceof Prepared                     => $this->prepared = true,
            $event instanceof Failed                       => $this->conclude($event, Status::Failed),
            $event instanceof Errored                      => $this->conclude($event, Status::Errored),
            $event instanceof Skipped                      => $this->conclude($event, Status::Skipped),
            $event instanceof MarkedIncomplete             => $this->conclude($event, Status::Incomplete),
            $event instanceof ConsideredRisky              => $this->raise($event->test(), Status::Risky),
            $event instanceof ErrorTriggered               => $this->raiseIssue($event, Status::Errored, $this->source->ignoreSuppressionOfErrors()),
            $event instanceof WarningTriggered             => $this->raiseIssue($event, Status::Warning, $this->source->ignoreSuppressionOfWarnings()),
            $event instanceof PhpWarningTriggered          => $this->raiseIssue($event, Status::Warning, $this->source->ignoreSuppressionOfPhpWarnings()),
            $event instanceof PhpunitWarningTriggered      => $this->raiseIssue($event, Status::Warning),
            $event instanceof NoticeTriggered              => $this->raiseIssue($event, Status::Notice, $this->source->ignoreSuppressionOfNotices()),
            $event instanceof PhpNoticeTriggered           => $this->raiseIssue($event, Status::Notice, $this->source->ignoreSuppressionOfPhpNotices()),
            $event instanceof PhpunitNoticeTriggered       => $this->raiseIssue($event, Status::Notice),
            $event instanceof DeprecationTriggered         => $this->raiseIssue($event, Status::Deprecation, $this->source->ignoreSuppressionOfDeprecations()),
            $event instanceof PhpDeprecationTriggered      => $this->raiseIssue($event, Status::Deprecation, $this->source->ignoreSuppressionOfPhpDeprecations()),
            $event instanceof PhpunitDeprecationTriggered  => $this->raiseIssue($event, Status::Deprecation),
            $event instanceof Finished                     => $this->finish($event),
            $event instanceof ExecutionFinished            => $this->separateFromSummary(),
            default                                        => null,
        };
    }

    private function testSuiteStarted(TestSuite $testSuite): void
    {
        if ($testSuite->isForTestClass()) {
            $this->testsOfClass = $testSuite->tests();
        }
    }

    /**
     * A failing before-class method stops the whole class, so PHPUnit
     * reports no per-test events for any of its tests.
     */
    private function printUnstartedTestsOfClass(Status $status): void
    {
        if ($this->testsOfClass !== null) {
            $this->printUnstarted($this->testsOfClass, $status);
        }

        $this->testsOfClass = null;
    }

    private function printUnstarted(TestCollection $tests, Status $status): void
    {
        foreach ($tests as $test) {
            $this->printRow($test, $status, null);
        }
    }

    private function start(PreparationStarted $event): void
    {
        $this->current   = $event->test();
        $this->startedAt = $event->telemetryInfo()->time();
        $this->prepared  = false;
        $this->status    = Status::Passed;
    }

    /**
     * PHPUnit sends Finished only for prepared tests, so an outcome that
     * arrives before Prepared is printed right away.
     */
    private function conclude(Failed|Errored|Skipped|MarkedIncomplete $event, Status $status): void
    {
        $test = $event->test();

        if (! $this->isCurrent($test)) {
            $this->printRow($test, $status, null);

            return;
        }

        if ($this->prepared) {
            $this->status = $this->status->worst($status);

            return;
        }

        $this->printRow($test, $status, $this->elapsed($event));

        $this->current = null;
    }

    private function raise(Test $test, Status $status): void
    {
        if ($this->isCurrent($test)) {
            $this->status = $this->status->worst($status);
        }
    }

    private function raiseIssue(
        ErrorTriggered|WarningTriggered|PhpWarningTriggered|PhpunitWarningTriggered|NoticeTriggered|PhpNoticeTriggered|PhpunitNoticeTriggered|DeprecationTriggered|PhpDeprecationTriggered|PhpunitDeprecationTriggered $issue,
        Status $status,
        bool $ignoreSuppression = true,
    ): void {
        if (! $ignoreSuppression && $issue->wasSuppressed()) {
            return;
        }

        foreach (['ignoredByBaseline', 'ignoredByTest', 'ignoredByFilter'] as $verdict) {
            if (method_exists($issue, $verdict) && $issue->{$verdict}()) {
                return;
            }
        }

        $this->raise($issue->test(), $status);
    }

    private function finish(Finished $event): void
    {
        if (! $this->isCurrent($event->test())) {
            return;
        }

        $this->printRow($event->test(), $this->status, $this->elapsed($event));

        $this->current = null;
    }

    private function separateFromSummary(): void
    {
        if ($this->run > 0) {
            fwrite($this->output, PHP_EOL);
        }
    }

    private function isCurrent(Test $test): bool
    {
        return $this->current?->id() === $test->id();
    }

    private function elapsed(Event $event): Duration
    {
        return $event->telemetryInfo()->time()->duration($this->startedAt);
    }

    private function printRow(Test $test, Status $status, ?Duration $duration): void
    {
        ++$this->run;

        $row = sprintf(
            '(%s/%d) %s %s',
            str_pad((string) $this->run, strlen((string) $this->total), ' ', STR_PAD_LEFT),
            $this->total,
            $this->colors ? $this->colorize($status->color(), $status->symbol()) : $status->char(),
            $this->colorize($status->nameColor(), $this->describe($test)),
        );

        if ($duration !== null) {
            $row .= sprintf(' (%s ms)', $this->formatDuration($duration));
        }

        fwrite($this->output, $row.PHP_EOL);
    }

    private function describe(Test $test): string
    {
        if (! $test instanceof TestMethod) {
            return $test->name();
        }

        $method  = $test->methodName();
        $variant = substr($test->name(), strlen($method));

        return $test->className().': '.ucfirst($this->splitCamels($this->splitSnakes($method))).$variant;
    }

    private function splitSnakes(string $name): string
    {
        return str_replace('_', ' ', $name);
    }

    private function splitCamels(string $name): string
    {
        return preg_replace('/(?<=[a-z])(?=[A-Z])|(?<=[A-Z])(?=[A-Z][a-z])/', ' ', $name);
    }

    private function formatDuration(Duration $duration): string
    {
        $milliseconds = (int) round($duration->asFloat() * 1000);

        return $milliseconds > 500 ? $this->colorize(Status::YELLOW, (string) $milliseconds) : (string) $milliseconds;
    }

    private function colorize(int $color, string $text): string
    {
        return $this->colors ? "\e[{$color}m{$text}\e[0m" : $text;
    }
}
