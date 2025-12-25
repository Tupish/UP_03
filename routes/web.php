<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'showMain'])->name('main_web');


Route::get('/auth/login', [HomeController::class, 'showLogin'])->name('login');


Route::get('/profile', [HomeController::class, 'showProfile'])->name('profile_web');


