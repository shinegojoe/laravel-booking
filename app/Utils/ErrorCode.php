<?php
namespace App\Utils;

class ErrorCode
{
    public static const NOT_FOUND = 999;
    public static const NO_AFFECTED = 998;
    public static const ALREADY_EXISTS = 997;
    public static const ROLL_BACK = 996;
    public static const AUTHENTICATION_FAILED = 995;
    public static const BOOKING_FAILED = 994;
    public static const GOOGLE_AUTH_CODE_ERROR = 993;
    public static const TOKEN_FAILED = 992;
    public static const GOOGLE_ADD_EVENT_FAILED = 991;

    public static function getMsg(int $code) {
        $map[999] = "NOT_FOUND";
        $map[998] = "NO_AFFECTED";
        $map[997] = "ALREADY_EXISTS";
        $map[996] = "ROLL_BACK";
        $map[995] = "AUTHENTICATION_FAILED";
        $map[994] = "BOOKING_FAILED";
        $map[993] = "GOOGLE_AUTH_CODE_ERROR";
        $map[992] = "TOKEN_FAILED";
        $map[991] = "GOOGLE_ADD_EVENT_FAILED";
        return $map[$code];
    }
}