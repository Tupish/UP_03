<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MarkController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'showMain'])->name('main');

Route::get('/login',[HomeController::class,'showLogin'])->name('login');
Route::post('/login', [HomeController::class, 'login']);

Route::get('/register',[HomeController::class,'showRegister'])->name('register');
Route::post('/register', [HomeController::class, 'register']);

Route::get('/profile',[HomeController::class,'showProfile'])->name('profile')->middleware('auth');;

