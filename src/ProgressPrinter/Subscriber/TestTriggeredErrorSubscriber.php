<?php declare(strict_types=1);

namespace ggrptr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use PHPUnit\Event\Test\ErrorTriggered;
use PHPUnit\Event\Test\ErrorTriggeredSubscriber;

final class TestTriggeredErrorSubscriber extends AbstractSubscriber implements ErrorTriggeredSubscriber
{
    public function notify(ErrorTriggered $event): void
    {
        $this->printer()->testTriggeredError($event);
    }
}
