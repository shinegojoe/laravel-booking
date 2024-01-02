<?php
namespace App\Utils;

use App\Utils\ErrorCode;
use Illuminate\Support\Str;

class ErrorInfo {

    private $code;
    private $message;
    private $detail;
    public function __construct($code, $detail) {
        $this->code = $code;
        $this->message = ErrorCode::getMsg($code);
        $this->detail = $detail;
    }

}

class AppResponse {


    public static function errorResp(int $code, string $detail) {
        $error = new ErrorInfo($code, $detail);
        $message = "failed";
        return response()->json(["message"=> $message,"error"=> $error]);

    }

    public static function successResp($data) {
        $newData = array();
        foreach ($data->toArray() as $key => $value) {
            $newKey = Str::camel($key);
            $newData[$newKey] = $value;
        }
        return response()->json(["message"=> "success","data"=> $newData]);
    }
}