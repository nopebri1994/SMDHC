<?php

namespace App\Services\Impl;

use App\Services\userServices;
use Illuminate\Support\Facades\Auth;

class userServiceImpl implements userServices
{
    function login(array $credentials): bool
    {
        if (Auth::attempt($credentials)) {
            return true;
        }
        return false;
    }
}
