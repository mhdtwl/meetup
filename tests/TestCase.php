<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $user;

    private function prepareForTests()
    {
        Artisan::call('migrate');
        Artisan::call('db:seed');
        Artisan::call('passport:install');
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->prepareForTests();

        $this->user = User::find(1);

        $isDebugMode = env('APP_DEBUG');
        $this->assertFalse($isDebugMode,
            "Make sure env-debug is false.\nThis not to have html response in some tests ");
    }
}