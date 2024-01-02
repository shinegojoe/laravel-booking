<?php
namespace App\Http\Controllers;

use App\Exceptions\GlobalException;
use App\Http\Services\UserService;
use App\Http\Services\BookingService;
use App\Http\Services\DefaultConfigService;
use App\Http\Services\CourseRegistrationService;
use App\Utils\AppResponse;
use Exception;
use Illuminate\Http\Request;


class BookginController extends Controller {

    private UserService $userService;
    private BookingService $bookingService;
    private DefaultConfigService $defaultConfigService;
    private CourseRegistrationService $courseRegistrationService;

    public function __construct(UserService $userService, BookingService $bookingService, DefaultConfigService $defaultConfigService, CourseRegistrationService $courseRegistrationService) {
        $this->userService = $userService;
        $this->bookingService = $bookingService;
        $this->defaultConfigService = $defaultConfigService;
        $this->courseRegistrationService = $courseRegistrationService;
    }
    public function create(Request $request) {
        try {
            $courseId = $request->input("courseId");
            $uId = $request->input("uId");
            $body = $request->input();
            $courseRegistraton = $this->courseRegistrationService->getByUIdAndCourseId($uId, $courseId);
            if($courseRegistraton === null) {
                $data = array();
                $data["courseId"] = $courseId;
                $data["create_time"] = time();
                $data["point"] = 0;
                $data["userId"] = $uId;
                $res = $this->courseRegistrationService->create($data);
            }
            $res = $this->bookingService->create($body);
            return AppResponse::successResp($res);


        } catch (Exception $e) {
            throw new GlobalException($e->getCode());
        }
    }

    public function bookingHistory(Request $request) {
        try {
            $courseId = $request->query("courseId");
            $uId = $request->query("uId");
            $res = $this->bookingService->bookingHistoryByUIdAndCourseId($courseId, $uId);
            return AppResponse::successResp($res);
        } catch (Exception $e) {
            throw new GlobalException($e->getCode());
        }
    }

    public function customerHistory(Request $request) {
        try {
            $courseId = $request->query("courseId");
            $uId = $request->query("uId");
            $res = $this->bookingService->bookingHistoryByUIdAndCourseId($courseId, $uId);
            return AppResponse::successResp($res);

        } catch (Exception $e) {
            throw new GlobalException($e->getCode());
        }
    }

    public function update(Request $request) {
        try {
            $body = $request->input();
            $res = $this->bookingService->update($body);
            return AppResponse::successResp($res);
        } catch (Exception $e) {
            throw new GlobalException($e->getCode());
        }
    }
}

