<?php

namespace App\DataTransfer;

class NotificationSentDTO
{
    public int $user_id;
    public string $user_name;
    public int $category_id;
    public int $channel_id;
    public int $notification_id;
    public string $status;

    public function toArray()
    {
        return get_object_vars($this);
    }
}
