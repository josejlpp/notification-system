<?php

namespace App\Adapters;

use Core\Entities\Notification;
use Core\Entities\User;
use Core\Publisher\Contracts\IPublisherAdapter;

class PushNotificationPublishAdapter implements IPublisherAdapter
{
    public function publishMessage(User $user, Notification $notification): bool
    {
        return true;
    }
}
