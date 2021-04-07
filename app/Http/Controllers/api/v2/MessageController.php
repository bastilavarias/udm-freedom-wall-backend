<?php

namespace App\Http\Controllers\api\v2;

use App\Common\Helper;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "text" => "required",
        ]);

        if ($validator->fails()) {
            $validatorMessages = $validator->messages();
            $errorMessage = Helper::getValidatorErrorMessage(
                $validatorMessages,
                ["text"]
            );
            return Helper::apiResponse(false, $errorMessage, null, 400);
        }

        $formData = [
            "text" => $request->input("text"),
            "people_id" => $request->input("people_id"),
        ];

        $createdMessage = Message::create($formData);
        $message = Message::with("people")->find($createdMessage->id);

        return Helper::apiResponse(
            true,
            "Successfully created record.",
            $message
        );
    }
}
