<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Services\PaymentHistoryService;
use App\Http\Services\CourseRegistrationService;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GlobalException;
use App\Utils\AppResponse;
use App\Utils\ErrorCode;


class PaymentHistoryController extends Controller {

    private PaymentHistoryService $paymentHistoryService;
    private CourseRegistrationService $courseRegistrationService;
    public function __construct(PaymentHistoryService $paymentHistoryService, CourseRegistrationService $courseRegistrationService) {
        $this->paymentHistoryService = $paymentHistoryService;
        $this->courseRegistrationService = $courseRegistrationService;
    }
    public function create(Request $request) {
        try {
            DB::beginTransaction();
            $x = $request->input();
            $uId = $request->input("uId");
            $courseId = $request->input("courseId");
            $point = $request->input("point");
            $res = $this->paymentHistoryService->create($x);
            $res = $this->courseRegistrationService->getByUIdAndCourseId($uId, $courseId);

            if($res) {
                $newPoint = $res["point"] + $point;
                $res = $this->courseRegistrationService->updatePoint($courseId, $uId, $newPoint);
                DB::commit();
                return AppResponse::successResp($res);
            } else {
                DB::rollBack();
                return AppResponse::errorResp(ErrorCode::NOT_FOUND, "course not found");
            }


        } catch(Exception $e) {
            DB::rollBack();
            throw new GlobalException($e->getMessage());
        } 

    }

    public function update(Request $request) {
        try {
            $body = $request->input();
            $this->paymentHistoryService->update($body["id"], $body);
            return AppResponse::successResp($body);

        } catch(Exception $e) {
            throw new GlobalException($e->getMessage());

        }

    }

    public function listByCourseIdAndUId(Request $request) {
        try {
            $courseId = $request->input("courseId");
            $uId = $request->input("uId");
            $data = $this->paymentHistoryService->listByCourseIdAndUId($courseId, $uId);
            return AppResponse::successResp($data);

        } catch(Exception $e) {
            throw new GlobalException($e->getMessage());

        }

    }



}
