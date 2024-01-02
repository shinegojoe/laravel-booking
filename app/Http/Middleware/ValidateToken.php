<?php
namespace App\Http\Middleware;
use App\Utils\AppResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Closure;
use Illuminate\Support\Facades\Log;
use App\Utils\JWTHelper;
use Exception;
use App\Utils\ErrorCode;

class ValidateToken {

    public function handle(Request $request, Closure $next): Response
    {
     
        try {
            $tokenString = $request->header('authorization', '??');
            Log::info($tokenString);
            $tokenString = explode(" ", $tokenString);
            Log::info($tokenString);        
            $tokenObj = JWTHelper::decode($tokenString[1]);
            $isValidate = JWTHelper::verify($tokenObj);
            $payload = $tokenObj->getPayload();
            $userId = $payload->findClaimByName("user_id")->getValue();

            if( $isValidate ) {
                $request["userId"] =$userId;
                return $next($request);
            } else {
                return AppResponse::errorResp(ErrorCode::$AUTHENTICATION_FAILED, "parse token failed");    
            }

        } catch(Exception $e) {
            
            return AppResponse::errorResp(ErrorCode::$AUTHENTICATION_FAILED, $e->getMessage());
        }
      
    }

}
