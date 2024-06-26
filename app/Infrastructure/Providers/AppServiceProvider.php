<?php

declare(strict_types=1);

namespace App\Infrastructure\Providers;

use App\Domain\Contracts\Services\AuthenticationServiceContract;
use App\Infrastructure\Services\AuthenticationService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        AuthenticationServiceContract::class => AuthenticationService::class,
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('api', static fn (Request $request) => Limit::perMinute(60)->by($request->user()?->id ?: $request->ip()));
    }
}
