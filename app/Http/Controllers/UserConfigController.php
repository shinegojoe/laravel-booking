<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GlobalException;
use App\Http\Services\UserConfigService;
use App\Utils\AppResponse;


class UserConfigController extends Controller {

    private UserConfigService $userConfigService;
    public function __construct(UserConfigService $userConfigService) {
        $this->userConfigService = $userConfigService;
    }
    public function update() {

    }

    public function updateIsSyncCalendar(Request $request) {
        try {
            $uId = $request->query("uId");
            $isSyncCalendar = $request->input("isSyncCalendar");
           
            $userConfig = $this->userConfigService->updateIsSyncCalendar($uId, $isSyncCalendar);
            Log::info($userConfig);
            return AppResponse::successResp($userConfig);
        } catch(Exception $e) {
            throw new GlobalException($e->getMessage());
        }            



    }

    public function updateIsDefaultCoach(Request $request) {
        try {
            $uId = $request->query("uId");
            $isDefaultCoach = $request->input("isDefaultCoach");
            $res = $this->userConfigService->updateIsDefaultCoach($uId, $isDefaultCoach);
            return AppResponse::successResp($res);
        } catch(Exception $e) {
            throw new GlobalException($e->getMessage());
        }       

    }


}
