<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GlobalException;
use Illuminate\Support\Facades\Http;

use WpOrg\Requests\Requests;
use App\Http\Services\GoogleApiService;
use App\Http\Services\UserService;


class LoginController extends Controller {

    private GoogleApiService $googleApiService;
    private UserService $userService;
    public function __construct(GoogleApiService $googleApiService, UserService $userService) {
        $this->googleApiService = $googleApiService;
        $this->userService = $userService;
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
                // create user
            } else {

            }
            // $response = Http::withHeaders([
            //     'Content-Type' => 'application/x-www-form-urlencoded',
            // ])->post($url, $body);



            return response()->json($tokenResp);

        } catch(Exception $e) {
            throw new GlobalException($e->getMessage());
        }
    }

    public function isValidate() {

    }

    public function checkLogin() {

    }


}
