<?php

namespace App\Repository;

use App\Models\User as UserModel;

class UserRepository
{
    public function getByCategory(int $category)
    {
        $users = UserModel::factory(10)->make();
        return $users->reject(function ($user) use ($category) {
            return in_array($category, $user->channels);
        });
    }
}
