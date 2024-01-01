<?php
namespace App\Http\Services;
use App\Models\CourseRegistration;
use App\Utils\TableNameString;
use Illuminate\Support\Facades\DB;



class CourseRegistrationService {

    private string $courseTable;
    private string $courseRegistrationTable;
    public function __construct(TableNameString $tableNameString) {
        $this->courseTable = TableNameString::courseRegistraction;
        $this->courseRegistrationTable = TableNameString::courseRegistraction;
    }

    public function getByUIdAndCourseId(string $uId, string $courseId) {
        $data = CourseRegistration::where("user_id", $uId)->where("course_id", $courseId)->first();
        return $data;
    }

    public function updatePoint(string $courseId, string $userId, int $newPoint) {
        CourseRegistration::where("user_id", $userId)->where("course_id", $courseId)->update(["point"=> $newPoint]);
        
    }

    public function listByUId(string $uId) {
        $data = CourseRegistration::where("user_id", $uId)->get();
        return $data;
    }

    public function customerListVO(string $uId) {
        $sql = "select cr.point, cr.course_id, c.'name'  from $this->courseRegistrationTable cr inner join $this->courseTable c on cr.course_id = c.id where cr.user_id = ? and c.is_activate=?";
        $data = DB::select($sql, [$uId, true]);
        return $data;
    }

}