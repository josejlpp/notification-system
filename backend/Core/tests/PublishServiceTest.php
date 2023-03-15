<?php

namespace Core\tests;

use Core\Entities\User;
use Core\Entities\ValueObject\Email;
use Core\Services\PublishService;
use PHPUnit\Framework\TestCase;

class PublishServiceTest extends TestCase
{
    public function testPushNotification()
    {
        $user = new User(
            "Jose Luiz",
            new Email('name@gmail.com'),
            '551899999999'
        );

        $service = new PublishService();
        $result = $service->publish($user);
        $this->assertTrue($result);
    }
}
