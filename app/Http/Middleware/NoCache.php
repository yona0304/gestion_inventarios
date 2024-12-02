<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

use Closure;
use Illuminate\Http\Request;

class NoCache
{
    public function handle(Request $request, Closure $next)
    {

        $response = $next($request);
        if ($response && !$response instanceof BinaryFileResponse) {
            $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, proxy-revalidate, max-age=0');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
        }

        return $response;
    }
}
