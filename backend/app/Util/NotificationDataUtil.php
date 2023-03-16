<?php

namespace App\Util;

use App\DataTransfer\NotificationSentDTO;
use App\Models\User as UserModel;
use Core\Entities\Notification;
use Core\Entities\User;
use Core\Entities\ValueObject\Email;

class NotificationDataUtil
{
    public static function makeUserEntityFromUserModel(UserModel $user): User
    {
        $entity = new User(
            $user->id,
            $user->name,
            new Email($user->email),
            $user->phone_number
        );

        $entity->setChannels($user->channels);

        return $entity;
    }

    public static function buildNotificationSentDto(User $userEntity, Notification $notification): NotificationSentDTO
    {
        $user = $userEntity->toArray();
        $dataTransfer = new NotificationSentDTO();
        $dataTransfer->category_id = $notification->getCategory();
        $dataTransfer->notification_id = $notification->getId();
        $dataTransfer->user_id = $user['id'];
        $dataTransfer->user_name = $user['name'];
        return $dataTransfer;
    }
}
