<?php

use App\Http\Controllers\MarkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::apiResources([
    'marks' => MarkController::class,
]);
