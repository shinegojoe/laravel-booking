<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use App\Http\Services\CourseService;
use App\Http\Services\DefaultConfigService;
use App\Utils\AppResponse;


class CourseController extends Controller {
    
    private CourseService $courseService;
    private DefaultConfigService $defaultConfigService;
    public function __construct(CourseService $courseService, DefaultConfigService $defaultConfigService) {
        $this->courseService = $courseService;
        $this->defaultConfigService = $defaultConfigService;
    }

    public function create(Request $request) {
        $uId = $request->query("uId");
        $course = $request->input("course");
        $defaultConfig = $request->input("defaultConfig");
        try {
            DB::beginTransaction();
            $course->userId = $uId;
            $courseRes = $this->courseService->create($course);
            $defaultConfig["courseId"] = $courseRes["id"];
            $res = $this->defaultConfigService->create($defaultConfig);
            DB::commit();
            return AppResponse::successResp($res);
        } catch(Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }


    public function listByCoachId(Request $request) {
        try {
            $uId = $request->query("uId");
            $data = $this->courseService->listByCoachId($uId);
            return AppResponse::successResp($data);

        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    public function listByClientId(Request $request) {
        try {
            $uId = $request->query("uId");
            $data = $this->courseService->listByClientId($uId);
            return AppResponse::successResp($data);

        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deactivate(Request $request) {
        try {
            $body = $request->input("");
            $data = $this->courseService->update($body);
            return AppResponse::successResp($data);

        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function setActivate(Request $request) {
        try {
            $body = $request->input("");
            $data = $this->courseService->update($body);
            return AppResponse::successResp($data);

        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}
