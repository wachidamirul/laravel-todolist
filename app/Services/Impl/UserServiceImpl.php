<?php

namespace App\Services\Impl;

use App\Services\UserService;

class UserServiceImpl implements UserService
{
    private array $users = [
        "joko" => "05120512"
    ];

    function login(string $user, string $password): bool
    {
        if (!isset($this->users[$user])) {
            return false;
        }

        $truePass = $this->users[$user];
        return $password == $truePass;
    }
}
