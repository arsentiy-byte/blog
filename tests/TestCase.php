<?php

declare(strict_types=1);

namespace Tests;

use App\Infrastructure\Traits\ConfigTrait;

use function config;

use DateTime;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;
use RuntimeException;

abstract class TestCase extends BaseTestCase
{
    use ConfigTrait, CreatesApplication, DatabaseMigrations, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        if ( ! $this->isTestingEnvironment()) {
            throw new RuntimeException('Конфиги указаны неправильно, попробуйте почистить кэш');
        }

        $this->createPersonalAccessClients();
    }

    private function createPersonalAccessClients(): void
    {
        $clientRepository = new ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(
            null,
            'Test Personal Access Client',
            config('app.url'),
        );

        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->getAttribute('id'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
