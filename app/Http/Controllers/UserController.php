<?php

namespace App\Http\Controllers;
use App\Http\Services\UserService;
use App\Http\Services\UserConfigService;
use App\VO\UserVO;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GlobalException;
use App\Utils\AppResponse;


class UserController extends Controller {

    private UserService $userService;
    private UserConfigService $userConfigService;
    public function __construct(UserService $userService, UserConfigService $userConfigService) {
        // $this->userService = new UserService();
        $this->userService = $userService;
        $this->userConfigService = $userConfigService;

    }
    public function listByCourseId(Request $req) {
        $courseId = $req->query("courseId");
        $res = $this->userService->listByCourseId($courseId);
        return AppResponse::successResp($res);
    }


    public function userVO(Request $req) {
        try {
            $uId = $req->query("uId");
            $user = $this->userService->get($uId);
            $userConfig = $this->userConfigService->findOneByUId($uId);
            // $data;
            $userVO = new UserVO();
            $userVO->user = $user;
            $userVO->userConfig = $userConfig;
            Log::info($userConfig);
            return AppResponse::successResp($userVO);

        } catch(Exception $e) {
            throw new GlobalException($e->getMessage());

        }
      

    }
}
