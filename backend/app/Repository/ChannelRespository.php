<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class ChannelRespository
{
    public function getByKey(string $key)
    {
        return DB::table('channels')
            ->where('key', $key)
            ->first();
    }
}
