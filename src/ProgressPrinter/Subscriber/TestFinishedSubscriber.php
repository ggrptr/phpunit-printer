<?php declare(strict_types=1);

namespace ggrptr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use PHPUnit\Event\Test\Finished;
use PHPUnit\Event\Test\FinishedSubscriber;

final class TestFinishedSubscriber extends AbstractSubscriber implements FinishedSubscriber
{
    public function notify(Finished $event): void
    {
        $this->printer()->testFinished();
    }
}
