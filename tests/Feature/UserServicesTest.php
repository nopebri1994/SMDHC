<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\userServices;


class UserServicesTest extends TestCase
{

    private userServices $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(userServices::class);
    }

    public function testSample()
    {
        self::assertTrue(true);
    }
    public function testLogin()
    {
        self::assertTrue($this->userService->login(['username' => 'nopebri', 'password' => 'pwk_lionmetal2014']));
    }
}
