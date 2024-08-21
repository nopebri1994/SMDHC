<?php

namespace App\Services;

interface userServices
{
    function login(array $credentials): bool;
}
