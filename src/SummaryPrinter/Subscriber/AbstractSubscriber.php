<?php declare(strict_types=1);

namespace ggrptr\PHPUnitPrinter\SummaryPrinter\Subscriber;

use ggrptr\PHPUnitPrinter\SummaryPrinter\SummaryPrinter;

abstract class AbstractSubscriber
{
    private readonly SummaryPrinter $printer;

    public function __construct(SummaryPrinter $printer)
    {
        $this->printer = $printer;
    }

    protected function printer(): SummaryPrinter
    {
        return $this->printer;
    }
}
