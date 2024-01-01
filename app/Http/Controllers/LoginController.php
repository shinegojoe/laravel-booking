<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GlobalException;

use App\Http\Services\GoogleApiService;
use App\Http\Services\UserService;
use App\Http\Services\UserConfigService;
use App\Utils\JWTHelper;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Entity\User as UserEntity;
use App\Entity\UserConfig as UserConfigEntity;
use App\VO\UserVO;



class LoginController extends Controller {

    private GoogleApiService $googleApiService;
    private UserService $userService;

    private UserConfigService $userConfigService;
    public function __construct(GoogleApiService $googleApiService, UserService $userService, UserConfigService $userConfigService) {
        $this->googleApiService = $googleApiService;
        $this->userService = $userService;
        $this->userConfigService = $userConfigService;
    }

    private function createUser(array $userInfo) {
        $user = new UserEntity($userInfo); 
        $user = $this->userService->create($user);
        return $user;

    }

    private function createUserConfig(string $uId, $rehreshToken, $pic) {
        $body = array("userId"=>$uId, "googleAuthCode"=>$rehreshToken, "isActivate"=>true, "isDefaultCoach"=> false, "isSyncCalendar"=>false, "picture"=>$pic);
        $userConfig = (array) new UserConfigEntity($body);
        $userConfig = $this->userConfigService->create($userConfig);
        return $userConfig;

    }

    public function googleOauth2Login(Request $request) {
        
        try {
            $code = $request->input("code");
            $tokenResp = $this->googleApiService->getToken($code);
            $access_token = $tokenResp["access_token"];


            $userInfo = $this->googleApiService->getUserInfo($access_token);
            $email = $userInfo["email"];
            $user = $this->userService->findByEmail($email);
            
            if(user === null) {
                // create user, user config
                DB::beginTransaction();
                $user = $this->createUser($userInfo);
                $userConfig = $this->createUserConfig($user["id"], $access_token, $userInfo["picture"]);
                $token = JWTHelper::encode($user);
                $userVO = new UserVO($user, $userConfig, $token, 0);
                DB::commit();
                return response()->json($userVO);

            } else {
                $user = $this->userService->findByEmail($email);
                $userConfig = $this->userConfigService->findOneByUId($user["id"]);
                $token = JWTHelper::encode($user);
                $userVO = new UserVO($user, $userConfig, $token, 0);
                return response()->json($userVO);

            }
            // return response()->json($tokenResp);

        } catch(Exception $e) {
            DB::rollBack();
            throw new GlobalException($e->getMessage());
        }
    }

    public function isValidate() {

    }

    public function checkLogin() {

    }


}
