<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v2\AuthenticationController;
use App\Http\Controllers\api\v2\AdminController;
use App\Http\Controllers\api\v2\PeopleTypeController;
use App\Http\Controllers\api\v2\PeopleController;
use App\Http\Controllers\api\v2\MessageController;

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

Route::middleware("auth:api")
    ->prefix("people")
    ->group(function () {
        Route::get("/", [PeopleController::class, "index"]);
        Route::get("/{id}", [PeopleController::class, "show"]);
        Route::post("/", [PeopleController::class, "create"]);
        Route::put("/", [PeopleController::class, "update"]);
        Route::delete("/{id}", [PeopleController::class, "destroy"]);

        Route::get("/type", [PeopleTypeController::class, "index"]);
        Route::get("/type/{id}", [PeopleTypeController::class, "show"]);
        Route::post("/type", [PeopleTypeController::class, "create"]);
        Route::put("/type", [PeopleTypeController::class, "update"]);
        Route::delete("/type/{id}", [PeopleTypeController::class, "destroy"]);
    });

Route::prefix("message")->group(function () {
    Route::post("/", [MessageController::class, "create"]);
    Route::get("/account/{people_id}", [
        MessageController::class,
        "getAccountMessages",
    ]);
});
