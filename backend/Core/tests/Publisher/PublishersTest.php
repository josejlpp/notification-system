<?php

namespace Core\tests\Publisher;

use Core\Entities\Notification;
use Core\Entities\User;
use Core\Entities\ValueObject\Email;
use Core\Publisher\Contracts\IPublisherAdapter;
use Core\Publisher\PublisherCollection;
use Core\tests\Adapter\PublishTestAdapter;
use PHPUnit\Framework\TestCase;

class PublishersTest extends TestCase
{
    public function testCreatePublisherCollectionEmpty()
    {
        $collection = new PublisherCollection();
        $this->assertCount(0, $collection);
    }

    public function testCreatePublisherCollectionNotEmpty()
    {
        $collection = new PublisherCollection();
        $publisher = $this->createMock(IPublisherAdapter::class);
        $collection->addPublisher('sms', $publisher);
        $this->assertCount(1, $collection);
    }

    public function testGetPublisherFromPublisherCollection()
    {
        $collection = new PublisherCollection();
        $publisher = $this->createMock(IPublisherAdapter::class);
        $collection->addPublisher('sms', $publisher);
        $this->assertInstanceOf(IPublisherAdapter::class, $collection->getPublisher('sms'));
    }

    public function testPublishChannelNotExists()
    {
        $collection = new PublisherCollection();
        $this->assertNull($collection->getPublisher('test'));
    }

    public function testSendPushSuccess()
    {
        $notification = new Notification(
            1,
            1,
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit."
        );

        $user = new User(
            1,
            "Jose Luiz",
            new Email('name@gmail.com'),
            '551899999999'
        );

        $collection = new PublisherCollection();
        $publisherAdapterObj = new PublishTestAdapter();
        $collection->addPublisher('test', $publisherAdapterObj);
        $publisherAdapter = new PublishTestAdapter();

        $this->assertTrue($publisherAdapter->publishMessage($user, $notification));
    }
}
