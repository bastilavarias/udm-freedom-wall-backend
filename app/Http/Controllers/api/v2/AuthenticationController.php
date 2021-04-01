<?php

namespace App\Http\Controllers\api\v2;

use App\Common\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            "username" => $request->input("username"),
            "password" => $request->input("password"),
        ];

        return Helper::apiResponse(
            true,
            "Successfully created record.",
            $credentials
        );
    }
}
