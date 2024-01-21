<?php declare(strict_types=1);

namespace ggrptrr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use PHPUnit\Event\TestRunner\ExecutionStarted;
use PHPUnit\Event\TestRunner\ExecutionStartedSubscriber;

final class TestRunnerExecutionStartedSubscriber extends AbstractSubscriber implements ExecutionStartedSubscriber
{
    public function notify(ExecutionStarted $event): void
    {
        $this->printer()->testRunnerExecutionStarted($event);
    }
}
