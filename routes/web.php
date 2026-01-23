<?php

use App\Http\Controllers\EntryController;
use App\Http\Controllers\SystemController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function () {
    return view('public.home');
})->name('home');

// Privacy Policy
Route::get('/privacy-policy', [App\Http\Controllers\AboutController::class, 'privacyPolicy'])->name('privacy-policy');

// App Routes
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::view('dashboard', 'app.dashboard')->name('dashboard');

    // Entries
    Route::resource('entries', EntryController::class)->only(['index']);

});

// System information
Route::get('/version', [SystemController::class, 'version']);
Route::get('/info', [SystemController::class, 'info']);

require __DIR__.'/settings.php';
