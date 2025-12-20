<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'showMain'])->name('main');
Route::get('/login',[HomeController::class,'showLogin'])->name('login');
Route::get('/register',[HomeController::class,'showRegister'])->name('register');
