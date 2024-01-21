<?php declare(strict_types=1);

namespace ggrptrr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use PHPUnit\Event\Test\ConsideredRisky;
use PHPUnit\Event\Test\ConsideredRiskySubscriber;

final class TestConsideredRiskySubscriber extends AbstractSubscriber implements ConsideredRiskySubscriber
{
    public function notify(ConsideredRisky $event): void
    {
        $this->printer()->testConsideredRisky();
    }
}
