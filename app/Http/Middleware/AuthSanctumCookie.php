<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthSanctumCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tokenFromCookie = $request->cookie('auth_token');
        if (! $tokenFromCookie) {
            return $this->unauthorizedResponse($request);
        }
        $accessToken = PersonalAccessToken::findToken($tokenFromCookie);
        if (! $accessToken) {
            return $this->unauthorizedResponse($request);
        }
        $user = $accessToken->tokenable;
        Auth::login($user);
        // inject ke request supaya bisa dipanggil $request->user()
        $request->setUserResolver(fn() => $user);
        return $next($request);
    }

    private function unauthorizedResponse(Request $request): Response
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return redirect()->route('login');
    }
}
