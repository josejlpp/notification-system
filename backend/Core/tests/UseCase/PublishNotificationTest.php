<?php

namespace Core\tests\UseCase;

use Core\Contracts\IRepository;
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
        $repositoryMock = $this->createMock(IRepository::class);
        $publisherCollection = new PublisherCollection();

        $publisher = new PublishNotification($repositoryMock, $publisherCollection);
        $this->assertInstanceOf(PublishNotification::class, $publisher);
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

        $repositoryMock = $this->createMock(IRepository::class);
        $repositoryMock->method('getUserByCategory')->willReturn([$user]);

        $publisherAdapterObj = new PublishTestAdapter();
        $publisherCollection = new PublisherCollection();
        $publisherCollection->add('test', $publisherAdapterObj);

        $publisher = new PublishNotification($repositoryMock, $publisherCollection);
        $publisher->handle($notification);
    }
}
