<?php

namespace App\Listeners;

use App\Builder\BuilderPublishCollection;
use App\DataTransfer\NotificationSentDTO;
use App\Events\NotificationStored;
use App\Repository\ChannelRespository;
use App\Repository\NotificationSentRepository;
use App\Repository\UserRepository;
use App\Util\NotificationDataUtil;
use Core\UseCase\PublishNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NotificationStored $event): void
    {
        $publishCollection = BuilderPublishCollection::build();
        $publisher = new PublishNotification($publishCollection);
        $users = (new UserRepository())->getByCategory($event->notification->getCategory());
        foreach ($users as $user) {
            $userEntity = NotificationDataUtil::makeUserEntityFromUserModel($user);
            $response = $publisher->handle($userEntity, $event->notification);
            $notificationSentTransfer = NotificationDataUtil::buildNotificationSentDto($userEntity, $event->notification);
            $this->notificationSentStore($notificationSentTransfer, $response);
        }
    }

    private function notificationSentStore(NotificationSentDTO $notificationSentTransfer, array $response)
    {
        $sentNotificationRepository = new NotificationSentRepository();
        foreach ($response as $key => $channelResponse) {
            $channel = (new ChannelRespository())->getByKey($key);
            $notificationSentTransfer->channel_id = $channel->id;
            $notificationSentTransfer->status = $channelResponse ? 'Success' : 'Fail';
            $sentNotificationRepository->store($notificationSentTransfer);
        }
    }
}
