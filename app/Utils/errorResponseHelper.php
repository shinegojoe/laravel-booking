<?php

namespace App\Utils;

class ErrorResponseHelper {
    public static function success(string $message, array $data = []) {
        return response()->json(["message"=> $message,"data"=> $data]);
    }
}

