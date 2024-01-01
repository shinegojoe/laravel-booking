<?php
namespace App\Http\Services;
use Illuminate\Support\Facades\DB;
use App\Models\PaymentHistory;
use App\Models\XXX;

class PaymentHistoryService {
    public function __construct() {

    }

    public function create($body) {
        $res = XXX::create($body);
        return $res;
        // $sql = "insert into test123.xxx (name) values('test123')";
        
        // DB::insert($sql);
    }

    public function update($id, $body) {
        PaymentHistory::where("id", $id)->update($body);
    }

    public function listByCourseIdAndUId(string $courseId, string $uId) {
        $data = PaymentHistory::where("course_id", $courseId)->where("user_id", $uId)->get();
        return $data;
    }


}