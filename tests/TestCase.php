<?php

declare(strict_types=1);

namespace Tests;

use App\Traits\ConfigTrait;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use ConfigTrait, CreatesApplication, DatabaseMigrations, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        if ( ! $this->isTestingEnvironment()) {
            dd('Конфиги указаны неправильно, попробуйте почистить кэш');
        }
    }
}
