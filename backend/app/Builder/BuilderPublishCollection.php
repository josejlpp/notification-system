<?php

namespace App\Builder;

use App\Adapters\EmailPublishAdapter;
use App\Adapters\PushNotificationPublishAdapter;
use App\Adapters\SmsPublishAdapter;
use Core\Publisher\PublisherCollection;

class BuilderPublishCollection
{
    public static function build(): PublisherCollection
    {
        $smsAdapter = new SmsPublishAdapter();
        $emailAdapter = new EmailPublishAdapter();
        $pushAdapter = new PushNotificationPublishAdapter();
        $publishCollection = new PublisherCollection();
        $publishCollection->addPublisher('sms', $smsAdapter);
        $publishCollection->addPublisher('email', $emailAdapter);
        $publishCollection->addPublisher('push', $pushAdapter);

        return $publishCollection;
    }
}
