<?php declare(strict_types=1);

namespace ggrptrr\PHPUnitPrinter\ResultPrinter\Subscriber;

use ggrptrr\PHPUnitPrinter\ResultPrinter\ResultPrinter;

abstract class AbstractSubscriber
{
    private readonly ResultPrinter $printer;

    public function __construct(ResultPrinter $printer)
    {
        $this->printer = $printer;
    }

    protected function printer(): ResultPrinter
    {
        return $this->printer;
    }
}
