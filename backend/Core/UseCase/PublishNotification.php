<?php

namespace Core\UseCase;

use Core\Entities\Notification;
use Core\Entities\User;
use Core\Publisher\PublisherCollection;
use Mockery\Exception;

class PublishNotification
{
    private array $statusResponse = [];
    public function __construct(
        private readonly PublisherCollection $collection
    ){
        $this->valid();
    }

    public function handle(User $user, Notification $notification): array
    {
        $this->send($user, $notification);
        return $this->statusResponse;
    }

    private function send(User $user, Notification $notification): void
    {
        foreach ($user->getChannels() as $channel) {
            $this->statusResponse[$channel] = false;
            $response = $this->collection->getPublisher($channel)?->publishMessage($user, $notification);
            $this->statusResponse[$channel] = $response;
        }
    }

    private function valid(): void
    {
        if (!$this->collection->count()) {
            throw new Exception('The property PublisherCollection not be empty!');
        }
    }
}
