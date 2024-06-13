<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Middleware;

use Closure;

final class ForceJsonResponse
{
    public function handle($request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
