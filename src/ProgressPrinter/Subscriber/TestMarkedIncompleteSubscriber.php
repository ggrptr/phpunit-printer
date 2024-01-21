<?php declare(strict_types=1);

namespace ggrptrr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use PHPUnit\Event\Test\MarkedIncomplete;
use PHPUnit\Event\Test\MarkedIncompleteSubscriber;

final class TestMarkedIncompleteSubscriber extends AbstractSubscriber implements MarkedIncompleteSubscriber
{
    public function notify(MarkedIncomplete $event): void
    {
        $this->printer()->testMarkedIncomplete();
    }
}
