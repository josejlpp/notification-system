<?php

namespace App\Adapters;

use App\Models\CategoryModel;
use Core\Entities\Notification;
use Core\Entities\User;
use Core\Publisher\Contracts\IPublisherAdapter;
use Illuminate\Support\Facades\Mail;

class EmailPublishAdapter implements IPublisherAdapter
{
    public function publishMessage(User $user, Notification $notification): bool
    {
        try {
            $this->sendEmail($user, $notification);
            return true;
        } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return false;
        }
    }

    private function sendEmail($user, $notification): void
    {
        $category = CategoryModel::find($notification->getCategory());
        Mail::send('email-template', [
            'category' => $category->name,
            'text_message' => $notification->getMessage()
        ], function ($message) use ($user, $category) {
            $message
                ->to($user->getEmail())
                ->from('send@notifcation.com', "Notification System")
                ->subject("New from {$category->name}");
        });
    }
}
