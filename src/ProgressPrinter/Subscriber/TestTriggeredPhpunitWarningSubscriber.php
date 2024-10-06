<?php declare(strict_types=1);

namespace ggrptr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use PHPUnit\Event\Test\PhpunitWarningTriggered;
use PHPUnit\Event\Test\PhpunitWarningTriggeredSubscriber;

final class TestTriggeredPhpunitWarningSubscriber extends AbstractSubscriber implements PhpunitWarningTriggeredSubscriber
{
    public function notify(PhpunitWarningTriggered $event): void
    {
        $this->printer()->testTriggeredPhpunitWarning();
    }
}
