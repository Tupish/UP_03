<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'showMain'])->name('main');


Route::get('/auth/login', [HomeController::class, 'showLogin'])->name('login_web');
Route::get('/auth/register', [HomeController::class, 'showRegister'])->name('register_web');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [HomeController::class, 'showProfile'])->name('profile');
});
