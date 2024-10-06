<?php declare(strict_types=1);

namespace ggrptr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use PHPUnit\Event\Test\Prepared;
use PHPUnit\Event\Test\PreparedSubscriber;

final class TestPreparedSubscriber extends AbstractSubscriber implements PreparedSubscriber
{
    public function notify(Prepared $event): void
    {
        $this->printer()->testPrepared();
    }
}
