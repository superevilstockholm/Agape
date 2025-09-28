<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

use App\Models\ActivityLogs;

class ActivityLogsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        try {
            ActivityLogs::create([
                'user_id' => optional($request->user())->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->path(),
                'method' => $request->method(),
                'response_status' => $response->getStatusCode(),
            ]);
        } catch (Exception $e) {
            Log::error('Failed to write activity log: '.$e->getMessage());
        }

        return $response;
    }
}
