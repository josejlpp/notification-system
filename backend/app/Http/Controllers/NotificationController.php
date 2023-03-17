<?php

namespace App\Http\Controllers;

use App\Events\NotificationStored;
use App\Models\NotificationModel;
use App\Repository\NotificationRepository;
use Core\Entities\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function store(Request $request)
    {
        \Log::warning($request);
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
        return DB::table('notifications as n')
            ->join('categories as c', 'c.id', '=', 'n.category_id')
            ->get(['n.*', 'c.name as category']);
    }

    public function getSent()
    {
        return DB::table('notification_sent as ns')
            ->join('categories as c', 'c.id', '=', 'ns.category_id')
            ->join('channels as ch', 'ch.id', '=', 'ns.channel_id')
            ->get([
                'ns.id',
                'ns.user_name as user',
                'ns.status',
                'ns.notification_id',
                'ns.category_id',
                'ns.created_at',
                'ch.name as channel',
                'c.name as category',
            ]);
    }

    public function getByUser($id)
    {
        return DB::table('notification_sent')->where('user_id', $id)->get();
    }
}
