<?php

namespace Core\tests\Adapter;

use Core\Entities\Notification;
use Core\Entities\User;
use Core\Publisher\Contracts\IPublisherAdapter;

class PublishTestAdapter implements IPublisherAdapter
{
    public function publishMessage(User $user, Notification $notification): bool
    {
        $this->writeLog($user, $notification);
        return true;
    }

    private function writeLog($user, $notification)
    {
        $logFile = fopen("send_message_log_" . date('dmy') . ".txt", "a") or die("Unable to open file!");
        $text = "\n" . json_encode($user->toArray()) . ',' . json_encode($notification->toArray());
        fwrite($logFile, $text);
        fclose($logFile);
    }
}
