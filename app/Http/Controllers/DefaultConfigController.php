<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Services\DefaultConfigService;
use App\Http\Services\CourseService;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GlobalException;
use Exception;


class DefaultConfigController extends Controller {

    private CourseService $courseService;
    private DefaultConfigService $defaultConfigService;

    public function __construct(CourseService $courseService, DefaultConfigService $defaultConfigService) {
        $this->courseService = $courseService;
        $this->defaultConfigService = $defaultConfigService;
    }
    public function getByCourseId(Request $request) {
        try {
            $courseId = $request->query("courseId");
            $data = $this->defaultConfigService->getByCourseId($courseId);
            return response()->json($data);

        } catch(Exception $e) {
            throw new GlobalException($e->getMessage());

        }

    }

    public function update(Request $request) {
        try {
            DB::beginTransaction();
            $course = $request->input("course");
            $defaultConfig = $request->input("dedaultConfig");
            $this->courseService->update($course);
            $this->defaultConfigService->update($defaultConfig);
            DB::commit();
            return response()->json();

        } catch(Exception $e) {
            throw new GlobalException($e->getMessage());


        } 


    }


}
