<?php

use Illuminate\Support\Facades\Route;

// Auth
use App\Http\Controllers\AuthController;

// Master Data Controllers
use App\Http\Controllers\MasterData\NewsController;

// Auth
Route::post('login', [AuthController::class, 'login']);

// Public
Route::apiResource('news', NewsController::class)->only(['index', 'show']);

// Protected
Route::middleware(['auth:sanctum'])->group(function () {
    // Auth
    Route::post('logout', [AuthController::class, 'logout']);
    // Master Data
    Route::apiResource('news', NewsController::class)->parameters([
        'news' => 'news'
    ])->only('store', 'update', 'destroy');
});
