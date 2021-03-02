<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::prefix('post')->group(function () {
    Route::get('/', [PostController::class, "get"]);
    Route::post('/', [PostController::class, "create"]);
});
