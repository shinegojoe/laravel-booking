<?php

namespace App\Http\Controllers;
use App\Http\Services\CourseRegistrationService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Exceptions\GlobalException;
use Exception;
use App\Utils\AppResponse;

class CourseRegistartionController extends Controller {

    private CourseRegistrationService $courseRegistrationService;

    public function __construct(CourseRegistrationService $courseRegistrationService) {
        $this->courseRegistrationService = $courseRegistrationService;
    }
    public function getByUIdAndCourseId(request $request) {
        try {
            $courseId = $request->input("courseId");
            $uId = $request->input("uId");
            $data = $this->courseRegistrationService->getByUIdAndCourseId($uId, $courseId);
            return AppResponse::successResp($data);

        } catch(Exception $e) {
            throw new GlobalException($e->getMessage());

        }
    }

    public function listByUId(Request $request) {
        try {
            $uId = $request->input("uId");
            $data = $this->courseRegistrationService->listByUId($uId);
            return AppResponse::successResp($data);

        } catch(Exception $e) {
            throw new GlobalException($e->getMessage());

        }
    }

    public function customerListVO(Request $request) {
        try {
            $uId = $request->input("uId");
            $data = $this->courseRegistrationService->listByUId($uId);
            return AppResponse::successResp($data);

        } catch(Exception $e) {
            throw new GlobalException($e->getMessage());

        }
    }

}
