<?php

namespace App\Common;

class Helper
{
    public static function apiResponse($success, $message, $data, $code = 200)
    {
        $apiResponse = [
            "code" => $code,
            "success" => $success,
            "success_message" => $message,
            "error" => !$success,
            "error_message" => !$success ? $message : null,
            "data" => $data
        ];
      return response($apiResponse, $code);

    }
}
