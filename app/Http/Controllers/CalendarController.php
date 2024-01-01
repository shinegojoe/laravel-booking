<?php
namespace App\Http\Controllers;

use App\Exceptions\GlobalException;
use App\Http\Services\BookingService;
use App\Http\Services\DefaultConfigService;
use App\Http\Services\CourseService;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use App\Utils\ErrorResponseHelper;
use App\Utils\JWTHelper;
use App\Models\XXX;

use App\Utils\BodyHelper;


class CalendarController extends Controller
{

    private BookingService $bookingService;
    private CourseService $courseService;

    private DefaultConfigService $defaultConfigService;

    public function __construct(BookingService $bookingService, CourseService $courseService, DefaultConfigService $defaultConfigService)
    {
        $this->bookingService = $bookingService;
        $this->courseService = $courseService;
        $this->defaultConfigService = $defaultConfigService;
    }

    public function booking(Request $request)
    {
        try {
            $body = $request->input();
            $body = BodyHelper::toSnake($body);
            $res = XXX::create($body);
            return response()->json($res);
            // $msg = "xx123";
            // // $data["res"] = "ok";
            // $payload = array("data" => "xx123", "exp" => 123);
            // $token = JWTHelper::encode($payload);
            // $data["token"] =  $token;
            
            // $tokenObj = JWTHelper::decode($token);
            // $data["p"] = $tokenObj->getPayload();
            // $v = JWTHelper::verify($tokenObj);
            // $data["v"] =  $v;

            // $resp = ErrorResponseHelper::success($msg, $data);
            // return $resp;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

    public function coachCalendar(Request $request)
    {
        try {

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

    public function customerCalendar(Request $request)
    {
        try {

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

}
