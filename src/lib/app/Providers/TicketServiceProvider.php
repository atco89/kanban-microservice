<?php
declare(strict_types=1);

namespace App\Providers;

use App\Models\Mapper\Mapper;
use App\Repositories\TicketRepository;
use App\Services\Interfaces\TicketService;
use App\Services\TicketServiceImpl;
use Illuminate\Support\ServiceProvider;

/**
 * Class TicketServiceProvider
 * @package App\Providers
 */
class TicketServiceProvider extends ServiceProvider
{

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(TicketService::class, function ($app) {
            return new TicketServiceImpl($app->make(Mapper::class)->load(), $app->make(TicketRepository::class));
        });
    }
}
