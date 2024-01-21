<?php declare(strict_types=1);

namespace ggrptrr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use PHPUnit\Event\Test\Failed;
use PHPUnit\Event\Test\FailedSubscriber;

final class TestFailedSubscriber extends AbstractSubscriber implements FailedSubscriber
{
    public function notify(Failed $event): void
    {
        $this->printer()->testFailed();
    }
}
