<?php

namespace App\Http\Controllers;

use App\Events\NotificationStored;
use App\Models\NotificationModel;
use App\Repository\NotificationRepository;
use Core\Entities\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function store(Request $request)
    {
        $notificationModel = (new NotificationRepository())->store($request->all());
        $notification = new Notification(
            $notificationModel->id,
            $notificationModel->category_id,
            $notificationModel->message
        );
        NotificationStored::dispatch($notification);

        return response(['Notification Created!'], 201);
    }

    public function show()
    {
        return NotificationModel::all();
    }
}
