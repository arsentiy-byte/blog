<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Console\Kernel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use RuntimeException;

/**
 * @mixin DatabaseMigrations
 */
trait CreatesApplication
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
        $this->seed();
    }

    public function createApplication(): Application
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        $this->validateDatabase();

        return $app;
    }

    private function validateDatabase(): void
    {
        if ('sqlite' !== DB::getDefaultConnection()) {
            throw new RuntimeException(sprintf('Wrong testing database: %s', DB::getDefaultConnection()));
        }
    }
}
