<?php

namespace App\Http\Controllers\api\v2;

use App\Common\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            "username" => $request->input("username"),
            "password" => $request->input("password"),
        ];

        if (!Auth::attempt($credentials)) {
            return Helper::apiResponse(false, "Invalid credentials.", null);
        }

        $token = Auth::user()->createToken("authToken")->accessToken;
        $user = Auth::user();
        $response = [
            "user" => $user,
            "token" => $token,
        ];
        return Helper::apiResponse(
            true,
            "Successfully created record.",
            $response
        );
    }
}
