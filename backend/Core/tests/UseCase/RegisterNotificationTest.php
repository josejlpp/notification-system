<?php

namespace Core\tests\UseCase;

use Core\Contracts\IRepository;
use Core\DTO\NotificationDTO;
use Core\Entities\Notification;
use Core\UseCase\RegisterNotification;
use PHPUnit\Framework\TestCase;

class RegisterNotificationTest extends TestCase
{
    public function testCreateRegisterNotification()
    {
        $repository = $this->createMock(IRepository::class);
        $publish = new RegisterNotification($repository);

        $this->assertInstanceOf(RegisterNotification::class, $publish);
    }

    public function testRegisterNotificationMessage()
    {
        $repository = $this->createMock(IRepository::class);
        $register = new RegisterNotification($repository);

        $notificationDto = new NotificationDTO();
        $notificationDto->category = 1;
        $notificationDto->message = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";
        $this->assertInstanceOf(Notification::class, $register->handle($notificationDto));
    }
}
