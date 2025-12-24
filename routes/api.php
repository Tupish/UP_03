<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post("/login", [AuthController::class, "login"]);
Route::post("/register", [AuthController::class, "register"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware("role:admin")->group(function () {
        Route::apiResources([
            "users" => UserController::class,
        ]);
    });
    Route::post("/logout", [AuthController::class, "logout"]);
});


Route::apiResources([
    "marks" => MarkController::class,
]);
