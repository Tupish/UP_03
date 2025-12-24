<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'showMain'])->name('main');

Route::get('/login',[HomeController::class,'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register',[HomeController::class,'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/profile',[HomeController::class,'showProfile'])->name('profile')->middleware('auth');;

