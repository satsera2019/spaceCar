<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ApiRequestLog;

class LogApiRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $parameters = $request->all();

        // Mask sensitive fields before logging
        if (isset($parameters['password'])) {
            $parameters['password'] = '*****'; // Replace 'password' with asterisks
        }

        // Log request details
        ApiRequestLog::create([
            'session_id' => $request->ip(),
            'ip' => $request->ip(),
            'method' => $request->method(),
            'address' => $request->fullUrl(),
            'parameters' => json_encode($parameters),
            'response' => $response->getContent(),
        ]);

        return $response;
    }
}
