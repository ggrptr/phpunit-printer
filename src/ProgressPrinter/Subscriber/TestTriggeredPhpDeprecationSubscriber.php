<?php declare(strict_types=1);

namespace ggrptrr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use PHPUnit\Event\Test\PhpDeprecationTriggered;
use PHPUnit\Event\Test\PhpDeprecationTriggeredSubscriber;

final class TestTriggeredPhpDeprecationSubscriber extends AbstractSubscriber implements PhpDeprecationTriggeredSubscriber
{
    public function notify(PhpDeprecationTriggered $event): void
    {
        $this->printer()->testTriggeredPhpDeprecation($event);
    }
}
