<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v2\AuthenticationController;
use App\Http\Controllers\api\v2\AdminController;

Route::prefix("authentication")->group(function () {
    Route::post("/", [AuthenticationController::class, "login"]);
});

Route::middleware("auth:api")
    ->prefix("admin")
    ->group(function () {
        Route::get("/", [AdminController::class, "index"]);
        Route::post("/", [AdminController::class, "create"]);
    });
