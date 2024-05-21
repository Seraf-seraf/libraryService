<?php

namespace Observer;

use SplSubject;

class EventLogger implements \SplObserver
{
    public function update(SplSubject $subject, $eventInfo = null): void
    {
        $event = $eventInfo['event'];
        $data = $eventInfo['data'];

        file_put_contents(__DIR__ .'/../Log/log.txt', $event . $data . PHP_EOL, FILE_APPEND);
    }
}