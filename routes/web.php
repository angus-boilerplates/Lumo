<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('index');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Authenticated group (Verified as well)
Route::middleware([
    'auth',
    'verified',
])->group(function () {

    Route::view('dashboard', 'dashboard')->name('dashboard');

});

require __DIR__.'/auth.php';
