<?php declare(strict_types=1);

namespace ggrptrr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use PHPUnit\Event\Test\PhpNoticeTriggered;
use PHPUnit\Event\Test\PhpNoticeTriggeredSubscriber;

final class TestTriggeredPhpNoticeSubscriber extends AbstractSubscriber implements PhpNoticeTriggeredSubscriber
{
    public function notify(PhpNoticeTriggered $event): void
    {
        $this->printer()->testTriggeredPhpNotice($event);
    }
}
