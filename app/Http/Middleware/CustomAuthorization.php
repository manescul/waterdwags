<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomAuthorization
{
    protected const HEADER_X_SECRET = 'X-Secret';

    protected string $secret;

    public function __construct()
    {
        $this->secret = env('CUSTOM_AUTHORIZATION_SECRET');
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->isValidSecret($request)) {
            return $next($request);
        }

        return abort(403);
    }

    public function isValidSecret(Request $request): bool
    {
        return $request->hasHeader(self::HEADER_X_SECRET)
            && $request->header(self::HEADER_X_SECRET) === $this->secret;
    }
}
