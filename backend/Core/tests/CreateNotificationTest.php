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

    public function testCreateDifferentNotificationWithSameData()
    {
        $category1 = 1;
        $message1 = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";
        $notification1 = new Notification($category1, $message1);

        $category2 = 1;
        $message2 = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";
        $notification2 = new Notification($category2, $message2);

        $this->assertNotSame($notification1, $notification2);
    }
}
