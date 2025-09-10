<?php

use Illuminate\Support\Facades\Route;

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
});

Route::get('news', function () {
    return view('pages.news');
})->name('news');

Route::get('gallery', function () {
    return view('pages.gallery');
})->name('gallery');
