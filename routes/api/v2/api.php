<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v2\AuthenticationController;

Route::prefix("authentication")->group(function () {
    Route::post("/", [AuthenticationController::class, "login"]);
});
