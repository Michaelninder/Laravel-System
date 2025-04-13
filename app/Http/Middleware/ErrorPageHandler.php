<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class ErrorPageHandler
{
    public function handle($request, Closure $next)
    {
        try {
            return $next($request);
        } catch (Throwable $e) {
            $status = 500;

            if ($e instanceof HttpExceptionInterface) {
                $status = $e->getStatusCode();
            }

            if (in_array($status, [403, 404, 419, 500, 503])) {
                return response()->view('errors.show', ['error' => $status], $status);
            }

            throw $e; // Let Laravel handle the rest
        }
    }
}
