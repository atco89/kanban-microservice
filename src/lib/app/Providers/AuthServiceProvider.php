<?php

namespace App\Providers;

use App\Models\Mapper\Mapper;
use App\Repositories\UserRepository;
use App\Services\AuthServiceImpl;
use App\Services\Interfaces\AuthService;
use App\Services\UserServiceImpl;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(AuthService::class, function ($app) {
            return new AuthServiceImpl($app->make(Mapper::class)->load(), $app->make(UserRepository::class));
        });
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
