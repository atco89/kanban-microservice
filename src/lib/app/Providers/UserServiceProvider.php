<?php
declare(strict_types=1);

namespace App\Providers;

use App\Models\Mapper\Mapper;
use App\Repositories\UserRepository;
use App\Services\Interfaces\UserService;
use App\Services\UserServiceImpl;
use Illuminate\Support\ServiceProvider;

/**
 * Class UserServiceProvider
 * @package App\Providers
 */
class UserServiceProvider extends ServiceProvider
{

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(UserService::class, function ($app) {
            return new UserServiceImpl($app->make(Mapper::class)->load(), $app->make(UserRepository::class));
        });
    }
}
