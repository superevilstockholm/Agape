<?php

use Illuminate\Support\Facades\Route;

// Auth
use App\Http\Controllers\AuthController;

// Master Data Controllers
use App\Http\Controllers\MasterData\UserController;
use App\Http\Controllers\MasterData\NewsController;

// Auth
Route::post('login', [AuthController::class, 'login'])->middleware([
    'throttle:5,1'
]); 

// Public
Route::prefix('master-data')->group(function () {
    Route::apiResource('news', NewsController::class)->only(['index', 'show']);
});

// Protected
Route::middleware(['auth:sanctum'])->group(function () {
    // Activity Logs
    Route::middleware(['activity.logs'])->group(function () {
        // Auth
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('is-logged-in', [AuthController::class, 'isLoggedIn']);
        // Master Data
        Route::prefix('master-data')->group(function () {
            // Users
            Route::apiResource('users', UserController::class)->parameters([
                'users' => 'user'
            ]);
            // News
            Route::apiResource('news', NewsController::class)->parameters([
                'news' => 'news'
            ])->only('store', 'update', 'destroy');
        });
        // User
        Route::prefix('user')->group(function () {
            Route::get('profile', [UserController::class, 'userProfile']);
            Route::put('profile', [UserController::class, 'editUserProfile']);
        });
    });
});
