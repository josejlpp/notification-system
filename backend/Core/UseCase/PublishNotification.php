<?php

namespace Core\UseCase;

use Core\Contracts\IRepository;
use Core\Entities\Notification;
use Core\Publisher\PublisherCollection;

class PublishNotification
{
    public function __construct(
        private readonly IRepository $repository,
        private readonly PublisherCollection $collection
    ){}

    public function handle(Notification $notification)
    {
        try {
            $users = $this->repository->getUserByCategory($notification->getCategory());
            $this->send($users, $notification);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function send(array $users, Notification $notification)
    {
        foreach ($users as $user) {
            foreach ($user->getChannels() as $channel) {
                $this->collection->getPublisher($channel)?->publishMessage($user, $notification);
                $this->repository->storeSendMessage($user, $channel, $notification);
            }
        }
    }
}
