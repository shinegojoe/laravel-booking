<?php

namespace App\Utils;
use Illuminate\Support\Str;


class BodyHelper {

    public static function toSnake($body) {
        $res = array();
        foreach ($body as $key => $value) {
            $newKey = Str::snake($key);
            $res[$newKey] = $value;
        }
        return $res;
    }
}