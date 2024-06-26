<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Resources\Authentication;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class Resource extends JsonResource
{
    abstract public function getResponseArray(): array;

    final public function toArray(Request $request): array
    {
        return $this->getResponseArray();
    }
}
