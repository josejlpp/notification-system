<?php

namespace Core\UseCase;

use Core\Contracts\IRepository;
use Core\DTO\NotificationDTO;
use Core\Entities\Notification;

class RegisterNotification
{
    private NotificationDTO $notificationDto;
    private Notification $notificationEntity;
    public function __construct(
        private readonly IRepository $repository
    ) {}

    public function handle(NotificationDTO $notificationDto): Notification
    {
        $this->notificationDto = $notificationDto;

        try {
            $this->storeNotification();
            return $this->notificationEntity;
        } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            throw $e;
        }
    }

    private function storeNotification(): void
    {
        $notification = new Notification(
            $this->notificationDto->category,
            $this->notificationDto->message
        );

        $this->repository->storeNotification($notification);
        $this->notificationEntity = $notification;
    }
}
