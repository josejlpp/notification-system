<?php

namespace Core\tests;

use Core\Entities\Notification;
use PHPUnit\Framework\TestCase;

class CreateNotificationTest extends TestCase
{
    public function testCreateNotificationEntity()
    {
        $category = 1;
        $message = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";

        $notification = new Notification($category, $message);
        $this->assertInstanceOf(Notification::class, $notification);
    }
}
