<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('Content-Security-Policy', "default-src 'none'; script-src 'self'; connect-src 'self'; img-src 'self'; style-src 'self';");
        $response->headers->set('X-Frame-Options', "DENY");
        $response->headers->set('Content-Type', 'text/html; charset=UTF-8');
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        return $response;
    }
}
