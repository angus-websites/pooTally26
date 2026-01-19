<?php

use App\Http\Controllers\SystemController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function () {
    return view('public.home');
})->name('home');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// System information
Route::get('/version', [SystemController::class, 'version']);
Route::get('/info', [SystemController::class, 'info']);


require __DIR__.'/settings.php';
