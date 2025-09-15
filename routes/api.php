<?php

use Illuminate\Support\Facades\Route;

// Auth
use App\Http\Controllers\AuthController;

// Master Data Controllers
use App\Http\Controllers\MasterData\UserController;
use App\Http\Controllers\MasterData\NewsController;

// Auth
Route::post('login', [AuthController::class, 'login']);

// Public
Route::prefix('master-data')->group(function () {
    Route::apiResource('news', NewsController::class)->only(['index', 'show']);
});

// Protected
Route::middleware(['auth:sanctum'])->group(function () {
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
});
