<?php

namespace Core\tests\UseCase;

use Core\Entities\Notification;
use Core\Entities\User;
use Core\Entities\ValueObject\Email;
use Core\Publisher\PublisherCollection;
use Core\tests\Adapter\PublishTestAdapter;
use Core\UseCase\PublishNotification;
use Tests\TestCase;

class PublishNotificationTest extends TestCase
{
    public function testCreatePublishNotificationClass()
    {
        $publisherAdapterObj = new PublishTestAdapter();
        $publisherCollection = new PublisherCollection();
        $publisherCollection->addPublisher('test', $publisherAdapterObj);

        $notificationPublisher = new PublishNotification($publisherCollection);
        $this->assertInstanceOf(PublishNotification::class, $notificationPublisher);
    }

    public function testCreatePublishNotificationException()
    {
        $this->expectExceptionMessage('The property PublisherCollection not be empty!');
        $publisherCollection = new PublisherCollection();

        $notificationPublisher = new PublishNotification($publisherCollection);
    }

    public function testPublishNotificationSend()
    {
        $notification = new Notification(
            1,
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit."
        );

        $user = new User(
            "Jose Luiz",
            new Email('name@gmail.com'),
            '551899999999'
        );

        $user->setChannels(['test', 'email']);

        $publisherAdapterObj = new PublishTestAdapter();
        $publisherCollection = new PublisherCollection();
        $publisherCollection->addPublisher('test', $publisherAdapterObj);

        $notificationPublisher = new PublishNotification($publisherCollection);
        $responsePublisher = $notificationPublisher->handle($user, $notification);
        $this->assertIsArray($responsePublisher);
    }
}
