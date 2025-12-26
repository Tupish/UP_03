<?php

use App\Http\Controllers\Api\MarkController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/student/marks', [MarkController::class, 'getStudentMarks']);
    Route::get('/teacher/marks', [MarkController::class, 'getTeacherMarks']);

    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
});



