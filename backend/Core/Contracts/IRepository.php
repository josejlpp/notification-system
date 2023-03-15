<?php

namespace Core\Contracts;

use Core\Entities\Notification;

interface IRepository
{
    public function getUserByCategory(int $category): array;

    public function storeNotification(Notification $notificationMessage): Notification;

    public function storeSendMessage(mixed $user, $channel, Notification $notification): bool;
}
