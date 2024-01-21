<?php declare(strict_types=1);

namespace ggrptrr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use PHPUnit\Event\Test\WarningTriggered;
use PHPUnit\Event\Test\WarningTriggeredSubscriber;

final class TestTriggeredWarningSubscriber extends AbstractSubscriber implements WarningTriggeredSubscriber
{
    public function notify(WarningTriggered $event): void
    {
        $this->printer()->testTriggeredWarning($event);
    }
}
