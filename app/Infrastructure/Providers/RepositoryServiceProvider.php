<?php

declare(strict_types=1);

namespace App\Infrastructure\Providers;

use App\Domain\Contracts\Repositories\UserRepositoryContract;
use App\Infrastructure\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array<string, string>
     */
    public array $bindings = [
        UserRepositoryContract::class => UserRepository::class,
    ];
}
