<?php declare(strict_types=1);

namespace ggrptrr\PHPUnitPrinter\SummaryPrinter\Subscriber;

use PHPUnit\Event\Application\Finished;
use PHPUnit\Event\Application\FinishedSubscriber;

final class ApplicationFinishedSubscriber extends AbstractSubscriber implements FinishedSubscriber
{
    public function notify(Finished $event): void
    {
        $this->printer()->applicationFinished($event);
    }
}
