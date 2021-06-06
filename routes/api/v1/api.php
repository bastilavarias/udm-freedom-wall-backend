<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\PostController;

Route::prefix("post")->group(function () {
    Route::get("/", [PostController::class, "get"]);
    Route::post("/", [PostController::class, "create"]);
});
