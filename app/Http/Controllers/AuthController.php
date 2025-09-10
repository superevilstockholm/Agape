<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required|string|min:8|max:255',
            ]);

            $user = User::where('email', $validated['email'])->first();

            if (!$user || !Hash::check($validated['password'], $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'The provided credentials are incorrect.',
                ], 401);
            }
            $user->tokens()->delete();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'Login successful.',
                'data' => $user->only(['id', 'name', 'email']),
            ], 200)->withCookie(
                'auth_token', // cookie name
                $token, // cookie value
                60 * 24 * 30, // cookie expiration (30 days)
                '/', // cookie path
                null, // cookie domain
                false, // cookie secure
                false, // cookie httponly
                'Lax' // cookie samesite
            );
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        try {
            $request->user()->tokens()->delete();
            return response()->json([
                'status' => true,
                'message' => 'Logout successful.',
            ], 200)->withoutCookie('auth_token');
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
