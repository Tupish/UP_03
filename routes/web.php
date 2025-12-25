<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'showMain'])->name('main');

Route::get('/auth/login', [HomeController::class, 'showLogin'])->name('view.login');
Route::get('/auth/register', [HomeController::class, 'showRegister'])->name('view.register');

Route::get('/profile', [HomeController::class, 'showProfile'])->name('profile')->middleware('auth');

