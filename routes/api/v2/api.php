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
        Route::get("/{id}", [AdminController::class, "show"]);
        Route::post("/", [AdminController::class, "create"]);
        Route::put("/", [AdminController::class, "update"]);
        Route::delete("/{id}", [AdminController::class, "destroy"]);
    });
