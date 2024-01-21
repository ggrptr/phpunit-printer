<?php declare(strict_types=1);

namespace ggrptrr\PHPUnitPrinter\SummaryPrinter;

use PHPUnit\Event\Application\Finished;
use PHPUnit\Event\Facade;
use PHPUnit\TestRunner\TestResult\TestResult;
use PHPUnit\TextUI\Command\Result;
use PHPUnit\TextUI\Output\Printer;
use PHPUnit\Util\Color;

final class SummaryPrinter
{
    private readonly Printer $printer;
    private readonly bool $colors;
    private bool $countPrinted = false;

    public function __construct(Printer $printer, Facade $eventFacade, bool $colors)
    {
        $this->printer = $printer;
        $this->colors = $colors;

        $eventFacade->registerSubscribers(new Subscriber\ApplicationFinishedSubscriber($this));
    }

    public function applicationFinished(Finished $event): void
    {
        $result = \PHPUnit\TestRunner\TestResult\Facade::result();
        $this->print($result);
    }

    public function print(TestResult $result): void
    {
        if ($result->numberOfTestsRun() === 0) {
            $this->printWithColor(
                'fg-black, bg-yellow',
                'No tests executed!',
            );

            return;
        }

        if ($result->wasSuccessfulAndNoTestHasIssues() &&
            !$result->hasTestSuiteSkippedEvents() &&
            !$result->hasTestSkippedEvents()) {
            $this->printWithColor(
                'fg-black, bg-green',
                sprintf(
                    'OK (%d test%s, %d assertion%s)',
                    $result->numberOfTestsRun(),
                    $result->numberOfTestsRun() === 1 ? '' : 's',
                    $result->numberOfAssertions(),
                    $result->numberOfAssertions() === 1 ? '' : 's',
                ),
            );

            $this->printNumberOfIssuesIgnoredByBaseline($result);

            return;
        }

        $color = 'fg-black, bg-yellow';

        if ($result->wasSuccessful()) {
            if (!$result->hasTestsWithIssues()) {
                $this->printWithColor(
                    $color,
                    'OK, but some tests were skipped!',
                );
            } else {
                $this->printWithColor(
                    $color,
                    'OK, but there were issues!',
                );
            }
        } else {
            if ($result->hasTestErroredEvents() || $result->hasTestTriggeredPhpunitErrorEvents()) {
                $color = 'fg-white, bg-red';

                $this->printWithColor(
                    $color,
                    'ERRORS!',
                );
            } elseif ($result->hasTestFailedEvents()) {
                $color = 'fg-white, bg-red';

                $this->printWithColor(
                    $color,
                    'FAILURES!',
                );
            } elseif ($result->hasWarnings()) {
                $this->printWithColor(
                    $color,
                    'WARNINGS!',
                );
            } elseif ($result->hasDeprecations()) {
                $this->printWithColor(
                    $color,
                    'DEPRECATIONS!',
                );
            } elseif ($result->hasNotices()) {
                $this->printWithColor(
                    $color,
                    'NOTICES!',
                );
            }
        }

        $this->printCountString($result->numberOfTestsRun(), 'Tests', $color, true);
        $this->printCountString($result->numberOfAssertions(), 'Assertions', $color, true);
        $this->printCountString($result->numberOfErrors(), 'Errors', $color);
        $this->printCountString($result->numberOfTestFailedEvents(), 'Failures', $color);
        $this->printCountString($result->numberOfWarnings(), 'Warnings', $color);
        $this->printCountString($result->numberOfDeprecations(), 'Deprecations', $color);
        $this->printCountString($result->numberOfNotices(), 'Notices', $color);
        $this->printCountString($result->numberOfTestSuiteSkippedEvents() + $result->numberOfTestSkippedEvents(), 'Skipped', $color);
        $this->printCountString($result->numberOfTestMarkedIncompleteEvents(), 'Incomplete', $color);
        $this->printCountString($result->numberOfTestsWithTestConsideredRiskyEvents(), 'Risky', $color);
        $this->printWithColor($color, '.');

        $this->printNumberOfIssuesIgnoredByBaseline($result);

        $this->printIssuesByFiles($result);

    }

    private function printIssuesByFiles(TestResult $result) : void
    {
        $issuesByFiles = [];
        foreach ($result->errors() as $error) {
            $fileName = $error->file();
            if (!array_key_exists($fileName, $issuesByFiles)) {
                $issuesByFiles[$fileName] = 0;
            }
            $issuesByFiles[$fileName]++;
        }


        foreach ($result->testFailedEvents() as $failure) {
            $fileName = $failure->test()->file();
            if (!array_key_exists($fileName, $issuesByFiles)) {
                $issuesByFiles[$fileName] = 0;
            }
            $issuesByFiles[$fileName]++;
        }

        if (count($issuesByFiles) === 0) {
            return;
        }

        $this->printer->print(PHP_EOL);

        $this->printWithColor(
            'fg-red',
            'Issues by files:',
            true,
        );

        foreach ($issuesByFiles as $file => $cnt) {
            $this->printWithColor(
                'fg-red',
                sprintf(
                    '%s: %d',
                    $file,
                    $cnt
                ),
                true,
            );
        }
    }

    private function printCountString(int $count, string $name, string $color, bool $always = false): void
    {
        if ($always || $count > 0) {
            $this->printWithColor(
                $color,
                sprintf(
                    '%s%s: %d',
                    $this->countPrinted ? ', ' : '',
                    $name,
                    $count,
                ),
                false,
            );

            $this->countPrinted = true;
        }
    }

    private function printWithColor(string $color, string $buffer, bool $lf = true): void
    {
        if ($this->colors) {
            $buffer = Color::colorizeTextBox($color, $buffer);
        }

        $this->printer->print($buffer);

        if ($lf) {
            $this->printer->print(PHP_EOL);
        }
    }

    private function printNumberOfIssuesIgnoredByBaseline(TestResult $result): void
    {
        if ($result->hasIssuesIgnoredByBaseline()) {
            $this->printer->print(
                sprintf(
                    '%s%d issue%s %s ignored by baseline.%s',
                    PHP_EOL,
                    $result->numberOfIssuesIgnoredByBaseline(),
                    $result->numberOfIssuesIgnoredByBaseline() > 1 ? 's' : '',
                    $result->numberOfIssuesIgnoredByBaseline() > 1 ? 'were' : 'was',
                    PHP_EOL,
                ),
            );
        }
    }
}
