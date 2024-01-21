<?php declare(strict_types=1);

namespace ggrptrr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use PHPUnit\Event\Test\BeforeFirstTestMethodErrored;
use PHPUnit\Event\Test\BeforeFirstTestMethodErroredSubscriber;

final class BeforeTestClassMethodErroredSubscriber extends AbstractSubscriber
    implements BeforeFirstTestMethodErroredSubscriber
{
    public function notify(BeforeFirstTestMethodErrored $event): void
    {
        $this->printer()->beforeTestClassMethodErrored();
    }
}
