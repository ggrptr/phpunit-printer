<?php declare(strict_types=1);

namespace ggrptr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use PHPUnit\Event\Test\PhpunitDeprecationTriggered;
use PHPUnit\Event\Test\PhpunitDeprecationTriggeredSubscriber;

final class TestTriggeredPhpunitDeprecationSubscriber extends AbstractSubscriber implements PhpunitDeprecationTriggeredSubscriber
{
    public function notify(PhpunitDeprecationTriggered $event): void
    {
        $this->printer()->testTriggeredPhpunitDeprecation();
    }
}
