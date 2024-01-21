<?php declare(strict_types=1);

namespace ggrptrr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use PHPUnit\Event\Test\Errored;
use PHPUnit\Event\Test\ErroredSubscriber;

final class TestErroredSubscriber extends AbstractSubscriber implements ErroredSubscriber
{
    public function notify(Errored $event): void
    {
        $this->printer()->testErrored($event);
    }
}
