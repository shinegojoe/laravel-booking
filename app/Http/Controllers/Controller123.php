<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Throwable;
use App\Exceptions\GlobalException as GlobalException;
use App\Utils\AppResponse as AppResponse;
use Illuminate\Http\Request;


class Controller123 extends BaseController
{
    private $tableKeyMap;
    
    public function __construct() {
        $this->tableKeyMap['userId'] = 'user_id';
        $this->tableKeyMap['isActivate'] = 'is_activate';

    }
    function test2(Request $request)
    {
        $query = $request->query();
        return response()->json($query, 200);
    }

    function testPost(Request $request) {
        $body = $request->input();
        Log::info($body);
        // $x['res'] = "testPost";
        return response()->json($body, 200);
    }

    public function getVO($model) {
        $vo['userId'] = $model[$this->tableKeyMap['userId']];
        $vo['isActivate'] = $model[$this->tableKeyMap['isActivate']];
        $resp = new AppResponse($vo);
        return $resp;
    }


    public function index()
    {
        try {
            $c = Course::find('1b85be2f-0b98-42f3-9b3c-2b2f75b469d2');
        
            Log::info($c);
            if($c == null) {
                $x['res'] = "123";
                return response()->json($x, 200);
     
            } 
            // $userId = $c->userId;
            // Log::info($c);
            // Log::info($userId);
            return response()->json($this->getVo($c), 200);

        } catch(Exception $e) {
            // throw $e;
            throw new GlobalException($e->getMessage());

        }
        // return response()->json(['res'=> 'test123']);
      

        // $res = DB::select("select * from test123.course");
        // return response()->json($res);
    }

    public function t2()
    {
        $res = DB::select("select * from test123.course");
        return response()->json($res);
    }

}
