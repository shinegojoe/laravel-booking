<?php
namespace App\Utils;

use App\Utils\ErrorCode;
use Illuminate\Support\Str;
use JsonSerializable;


class ErrorInfo  implements JsonSerializable {

    private $code;
    private $message;
    private $detail;
    public function __construct($code, $detail) {
        $this->code = $code;
        $this->message = ErrorCode::getMsg($code);
        $this->detail = $detail;
    }

    public function jsonSerialize() {
        return [
            'code' => $this->code,
            'message' => $this->message,
            'detail' => $this->detail,
        ];
    }

}

class AppResponse {


    public static function errorResp(int $code, string $detail, int $statusCode=200) {
        $error = new ErrorInfo($code, $detail);
        $message = "failed";
        return response()->json(["message"=> $message,"error"=> $error], $statusCode);

    }

    public static function successResp($data, int $statusCode= 200) {
        $newData = array();
        foreach ($data->toArray() as $key => $value) {
            $newKey = Str::camel($key);
            $newData[$newKey] = $value;
        }
        return response()->json(["message"=> "success","data"=> $newData], $statusCode);
    }
}