<?php

declare(strict_types=1);

namespace App\Infrastructure\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

trait ConfigTrait
{
    protected function isTestingContext(): bool
    {
        return $this->isTestingDatabase() && $this->isTestingEnvironment();
    }

    protected function isTestingDatabase(): bool
    {
        return 'sqlite' === DB::getDefaultConnection();
    }

    protected function isTestingEnvironment(): bool
    {
        return (bool) App::environment('testing');
    }

    protected function isProductionEnvironment(): bool
    {
        return App::isProduction();
    }

    protected function isDevelopmentEnvironment(): bool
    {
        return (bool) App::environment('development');
    }

    protected function getEnvironment(): bool|string
    {
        return App::environment();
    }

    protected function getPersonalAccessTokenName(): string
    {
        return config('app.personal_access_token_name');
    }
}
