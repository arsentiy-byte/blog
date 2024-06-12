<?php

declare(strict_types=1);

namespace App\Infrastructure\Models\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

final class Hashed implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        return $value;
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        return Hash::make($value);
    }
}
