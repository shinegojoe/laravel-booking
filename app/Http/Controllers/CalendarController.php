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
use App\Utils\AppResponse;


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
            $courseId = $request->query("courseId");
            $defaultConfig = $this->defaultConfigService->getByCourseId(courseId);
            $course = $this->courseService->findById($courseId);
            $bookingList = $this->bookingService->bookingCalendarData($courseId);
            $res = array("defaultConfig"=>$defaultConfig, "bookingList"=>$bookingList);
            return AppResponse::successResp($res);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

    public function coachCalendar(Request $request)
    {
        try {
            $uId = $request->query("uId");
            $data = $this->bookingService->coachCalendarData($uId);
            return AppResponse::successResp($data);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

    public function customerCalendar(Request $request)
    {
        try {
            $uId = $request->query("uId");
            $data = $this->bookingService->customerCalendarData($uId);
            return AppResponse::successResp($data);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

}
