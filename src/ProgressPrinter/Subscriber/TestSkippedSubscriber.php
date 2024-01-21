<?php declare(strict_types=1);

namespace ggrptrr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use PHPUnit\Event\Test\Skipped;
use PHPUnit\Event\Test\SkippedSubscriber;

final class TestSkippedSubscriber extends AbstractSubscriber implements SkippedSubscriber
{
    public function notify(Skipped $event): void
    {
        $this->printer()->testSkipped();
    }
}
