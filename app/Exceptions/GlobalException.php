<?php

namespace App\Exceptions;

use Exception;

class GlobalException extends Exception {

    // public function context(): array
    // {
    //     return ['order_id' => "xx123"];
    // }

    public function render($request)
    {
        $resp['error'] = "error";
        $resp['info'] = $this->getMessage();
        return response()->json($resp);
    }

}
