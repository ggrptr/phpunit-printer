<?php declare(strict_types=1);

namespace ggrptrr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use PHPUnit\Event\TestSuite\Started;
use PHPUnit\Event\TestSuite\StartedSubscriber;

class TestSuiteStartedSubscriber extends AbstractSubscriber implements StartedSubscriber
{
    public function notify(Started $event): void
    {
        $this->printer()->testSuiteStarted($event);
    }
}