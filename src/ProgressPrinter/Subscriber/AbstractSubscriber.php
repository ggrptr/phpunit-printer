<?php declare(strict_types=1);

namespace ggrptr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use ggrptr\PHPUnitPrinter\ProgressPrinter\ProgressPrinter;

abstract class AbstractSubscriber
{
    private readonly ProgressPrinter $printer;

    public function __construct(ProgressPrinter $printer)
    {
        $this->printer = $printer;
    }

    protected function printer(): ProgressPrinter
    {
        return $this->printer;
    }
}
