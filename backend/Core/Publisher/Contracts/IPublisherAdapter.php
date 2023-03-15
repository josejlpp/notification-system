<?php

namespace Core\Publisher\Contracts;

use Core\Entities\Notification;
use Core\Entities\User;

interface IPublisherAdapter
{
    public function publishMessage(User $user, Notification $notification): bool;
}
