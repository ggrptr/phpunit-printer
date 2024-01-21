<?php declare(strict_types=1);

namespace ggrptrr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use PHPUnit\Event\Test\DeprecationTriggered;
use PHPUnit\Event\Test\DeprecationTriggeredSubscriber;

final class TestTriggeredDeprecationSubscriber extends AbstractSubscriber implements DeprecationTriggeredSubscriber
{
    public function notify(DeprecationTriggered $event): void
    {
        $this->printer()->testTriggeredDeprecation($event);
    }
}
