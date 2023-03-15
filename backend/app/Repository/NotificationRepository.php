<?php

namespace App\Repository;

use App\Models\NotificationModel;

class NotificationRepository
{
    public function store(array $data)
    {
        return NotificationModel::create($data);
    }
}
