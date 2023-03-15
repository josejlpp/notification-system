<?php

namespace App\Listeners;

use App\BuilderPublishCollection;
use App\Events\NotificationStored;
use App\Repository\UserRepository;
use Core\Entities\User;
use App\Models\User as UserModel;
use Core\Entities\ValueObject\Email;
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
            $userEntity = $this->makeUserEntity($user);
            $response = $publisher->handle($userEntity, $event->notification);
            \Log::info([$userEntity->toArray(), $response]);
        }
    }

    private function makeUserEntity(UserModel $user): User
    {
        $entity = new User(
            $user->name,
            new Email($user->email),
            $user->phone_number
        );

        $entity->setChannels($user->channels);

        return $entity;
    }
}
