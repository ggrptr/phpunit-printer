<?php declare(strict_types=1);

namespace ggrptr\PHPUnitPrinter\ProgressPrinter\Subscriber;

use PHPUnit\Event\Test\NoticeTriggered;
use PHPUnit\Event\Test\NoticeTriggeredSubscriber;

final class TestTriggeredNoticeSubscriber extends AbstractSubscriber implements NoticeTriggeredSubscriber
{
    public function notify(NoticeTriggered $event): void
    {
        $this->printer()->testTriggeredNotice($event);
    }
}
