<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getUserById(string $email): ?User
    {
        return User::with('commands')->where('email', $email)->first();
    }
}
