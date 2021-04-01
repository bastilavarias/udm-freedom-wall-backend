<?php

namespace App\Http\Controllers\api\v2;

use App\Common\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "username" => "required",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            $validatorMessages = $validator->messages();
            $errorMessage = Helper::getValidatorErrorMessage(
                $validatorMessages,
                ["username", "password"]
            );
            return Helper::apiResponse(false, $errorMessage, null, 401);
        }

        $formData = [
            "username" => $request->input("username"),
            "password" => $request->input("password"),
        ];

        if (!Auth::attempt($formData)) {
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
