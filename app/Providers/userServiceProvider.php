<?php

namespace App\Providers;

use App\Services\Impl\userServiceImpl;
use App\Services\userServices;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

//jika dibutuhkan atau lazy
class userServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        userServices::class => userServiceImpl::class
    ];

    public function provides(): array
    {
        return [userServices::class];
    }
    /**
     * Register services.
     */
    public function register(): void {}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
