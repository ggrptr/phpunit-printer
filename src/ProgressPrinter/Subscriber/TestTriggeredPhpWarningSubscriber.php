<?php declare(strict_types=1);

namespace ggrptr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use PHPUnit\Event\Test\PhpWarningTriggered;
use PHPUnit\Event\Test\PhpWarningTriggeredSubscriber;

final class TestTriggeredPhpWarningSubscriber extends AbstractSubscriber implements PhpWarningTriggeredSubscriber
{
    public function notify(PhpWarningTriggered $event): void
    {
        $this->printer()->testTriggeredPhpWarning($event);
    }
}
