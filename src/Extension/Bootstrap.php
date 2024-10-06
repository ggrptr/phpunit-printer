<?php

namespace ggrptr\PHPUnitPrinter\Extension;

use PHPUnit\Event\Facade as EventFacade;
use PHPUnit\Runner\Extension\Extension;
use PHPUnit\Runner\Extension\Facade;
use PHPUnit\Runner\Extension\ParameterCollection;
use PHPUnit\TextUI\Configuration\Configuration;
use ggrptr\PHPUnitPrinter\ResultPrinter\ResultPrinter;
use PHPUnit\TextUI\Output\Default\ResultPrinter as DefaultResultPrinter;
use PHPUnit\TextUI\Output\DefaultPrinter;
use PHPUnit\TextUI\Output\NullPrinter;
use PHPUnit\TextUI\Output\Printer;
use ggrptr\PHPUnitPrinter\SummaryPrinter\SummaryPrinter;
use PHPUnit\TextUI\Output\TestDox\ResultPrinter as TestDoxResultPrinter;
use ggrptr\PHPUnitPrinter\ProgressPrinter\ProgressPrinter;

class Bootstrap implements Extension
{

    private Configuration $configuration;
    private EventFacade $eventFacade;
    private Printer $printer;

    public function bootstrap(Configuration $configuration, Facade $facade, ParameterCollection $parameters): void
    {
        $this->configuration = $configuration;
        $this->eventFacade = EventFacade::instance();

        $facade->replaceOutput();

        $this->printer = $this->createPrinter();
        $this->createProgressPrinter();
        $this->createResultPrinter();
        $this->createSummaryPrinter();

    }

    private function createPrinter(): Printer  {
        $printerNeeded = false;

        if ($this->configuration->debug()) {
            $printerNeeded = true;
        }

        if ($this->configuration->outputIsTeamCity()) {
            $printerNeeded = true;
        }

        if ($this->configuration->outputIsTestDox()) {
            $printerNeeded = true;
        }

        if (!$this->configuration->noOutput() && !$this->configuration->noProgress()) {
            $printerNeeded = true;
        }

        if (!$this->configuration->noOutput() && !$this->configuration->noResults()) {
            $printerNeeded = true;
        }

        if ($printerNeeded) {
            if ($this->configuration->outputToStandardErrorStream()) {
                return DefaultPrinter::standardError();
            } else {
                return DefaultPrinter::standardOutput();
            }
        } else {
            return new NullPrinter();
        }
    }

    private function createProgressPrinter(): void  {

        if ($this->configuration->noOutput() || $this->configuration->noProgress()) {
            return;
        }

        new ProgressPrinter(
            $this->printer,
            $this->eventFacade,
            $this->configuration
        );
    }

    private function createResultPrinter(): void  {
        if ($this->configuration->outputIsTestDox()) {
            new ResultPrinter(
                $this->printer,
                $this->eventFacade,
                true,
                true,
                true,
                false,
                false,
                true,
                false,
                false,
                $this->configuration->displayDetailsOnTestsThatTriggerDeprecations(),
                $this->configuration->displayDetailsOnTestsThatTriggerErrors(),
                $this->configuration->displayDetailsOnTestsThatTriggerNotices(),
                $this->configuration->displayDetailsOnTestsThatTriggerWarnings(),
                $this->configuration->reverseDefectList(),
            );

            // TODO View the original implementation of TestDoxResultPrinter in the PHPUnit source code, and check this
            /*
            new TestDoxResultPrinter(
                $this->printer,
                $this->configuration->colors(),
            );
            */

            return;
        }

        if ($this->configuration->noOutput() || $this->configuration->noResults()) {
            return;
        }


        new ResultPrinter(
            $this->printer,
            $this->eventFacade,
            true,
            true,
            true,
            true,
            true,
            true,
            $this->configuration->displayDetailsOnIncompleteTests(),
            $this->configuration->displayDetailsOnSkippedTests(),
            $this->configuration->displayDetailsOnTestsThatTriggerDeprecations(),
            $this->configuration->displayDetailsOnTestsThatTriggerErrors(),
            $this->configuration->displayDetailsOnTestsThatTriggerNotices(),
            $this->configuration->displayDetailsOnTestsThatTriggerWarnings(),
            $this->configuration->reverseDefectList(),
        );
    }

    private function createSummaryPrinter(): void {
        if (($this->configuration->noOutput() || $this->configuration->noResults()) &&
            !($this->configuration->outputIsTeamCity() || $this->configuration->outputIsTestDox())) {
            return;
        }

        new SummaryPrinter(
            $this->printer,
            $this->eventFacade,
            $this->configuration->colors()
        );
    }


}