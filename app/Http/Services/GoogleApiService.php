<?php
namespace App\Http\Services;
use WpOrg\Requests\Requests;
use Illuminate\Support\Facades\Log;


class GoogleApiService
{

    public function __construct()
    {

    }

    public function getToken(string $code)
    {
        // $hostname = env("IMAP_HOSTNAME_TEST", "somedefaultvalue");

        $url = "https://oauth2.googleapis.com/token";

        $body["grant_type"] = "authorization_code";
        $body["code"] = $code;
        $body["redirect_uri"] = env("REDIRECT_URL", "");
        $body["client_id"] = env("CLIENT_ID", "");
        $body["client_secret"] = env("SECRET", "");
        $h = array('Content-Type' => 'application/x-www-form-urlencoded');
        $response = Requests::post($url, $h, $body);
        return $response->decode_body();
    }

    public function getUserInfo(string $access_token) {
        Log::info($access_token);
        $url = "https://www.googleapis.com/oauth2/v2/userinfo";
        $headers = array('Authorization'=>"Bearer .$access_token");
        Log::info("h: ", $headers);

        $response = Requests::get($url, $headers);
        return $response->decode_body();
    }


}