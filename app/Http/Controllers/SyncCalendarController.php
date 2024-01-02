<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GlobalException;
use App\Http\Services\BookingService;
use App\Http\Services\UserConfigService;
use App\Http\Services\CourseService;
use App\Utils\AppResponse;


class SyncCalendarController extends Controller {

    private $bookingService;
    private $userConfigService;

    private $courseService;
    public function __construct(BookingService $bookingService, UserConfigService $userConfigService,
        CourseService $courseService) {
        $this->bookingService = $bookingService;
        $this->userConfigService = $userConfigService;
        $this->courseService = $courseService;
    }

    public function syncCalendar(Request $request) {
        
        try {
            $uId = $request->query("uId");
            $courseId = $request->query("courseId");
            $userBookingList = $this->bookingService->calendarListDTOByUserId($uId);
            $userConfig =  $this->userConfigService->findOneByUId($uId);
            $course = $this->courseService->findById($courseId);
            $data = $course;
            return AppResponse::successResp($data);

        } catch(Exception $e) {
            throw new GlobalException($e->getMessage(), $e->getCode(), $e);
        }

    }

}
