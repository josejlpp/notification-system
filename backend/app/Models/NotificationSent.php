<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationSent extends Model
{
    use HasFactory;

    protected $table = 'notification_sent';
    protected $fillable = [
        'user_id',
        'user_name',
        'category_id',
        'channel_id',
        'status'
    ];

    protected $dateFormat = ['created_at'];
}
