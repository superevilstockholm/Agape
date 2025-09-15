<?php

use Illuminate\Support\Facades\Route;

// Auth
Route::get('login', function () {
    return view('pages.auth.login', [
        'meta' => [
            'show_navbar' => false,
            'show_footer' => false
        ]
    ]);
})->name('login');

Route::get('/', function () {
    return view('pages.index');
})->name('index');

Route::prefix('institution')->group(function () {
    Route::get('jakarta', function () {
        return view('pages.institution.jakarta');
    })->name('institution.jakarta');
    Route::get('tangerang', function () {
        return view('pages.institution.tangerang');
    })->name('institution.tangerang');
    Route::get('serang', function () {
        return view('pages.institution.serang');
    })->name('institution.serang');
})->name('institution');

Route::get('news', function () {
    return view('pages.news');
})->name('news');

Route::get('gallery', function () {
    return view('pages.gallery');
})->name('gallery');

Route::middleware(['auth.sanctum.cookie'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', function () {
            return view('pages.dashboard.index');
        })->name('dashboard.index');
        Route::get('news', function () {
            return view('pages.dashboard.news');
        })->name('dashboard.news.index');
    })->name('dashboard');
});
