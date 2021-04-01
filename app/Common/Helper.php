<?php

namespace App\Common;

use Throwable;

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
            "data" => $data,
        ];
        return response($apiResponse, $code);
    }

    public static function getValidatorErrorMessage(
        $messages,
        $properties
    ): string {
        try {
            foreach ($properties as $property) {
                if ($messages->has($property)) {
                    return $messages->get($property)[0];
                }
            }
        } catch (Throwable $e) {
            return "Server Error.";
        }
        return "Server Error.";
    }
}
