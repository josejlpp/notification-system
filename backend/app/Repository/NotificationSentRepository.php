<?php

namespace App\Repository;

use App\DataTransfer\NotificationSentDTO;
use App\Models\NotificationSent;

class NotificationSentRepository
{
    public function store(NotificationSentDTO $notificationSentTransfer)
    {
        NotificationSent::create($notificationSentTransfer->toArray());
    }
}
