<?php
namespace App\Http\Services;
use App\Utils\TableNameString;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;

class BookingService {

    private $bookingTable;
    private $courseTable;
    public function __construct(TableNameString $tableNameString) {
        $this->bookingTable = $tableNameString::booking;
        $this->courseTable = $tableNameString::course;


    }
    public function calendarListDTOByUserId(string $userId) {
        // Log::info("userId: ", [$userId]);
        $sql = "select b.*, c.name as course_name from $this->bookingTable b inner join $this->courseTable c on b.course_id = c.id where b.user_id = ?";
        // $data = DB::select($sql, [$userId]);

        // $sql = "select * from test123.user";
        // $sql = "select b.*, c.name as course_name from test123.booking b inner join test123.course c on b.course_id = c.id where b.user_id = ?";
        $data = DB::select($sql, [$userId]);
        return $data;
    }

    public function update(array $body) {
        $res = Booking::where("id"-> $body["id"])->update($body);
        return $res;
    }

    public function bookingHistoryByUIdAndCourseId(string $uId, string $courseId) {
        $res = Booking::where("user_id"->$uId)->where("course_id", $courseId)->all();
        return $res;
    }

    public function create(array $body) {
        $res = Booking::create($body);
        return $res;
    }

    public function coachCalendarData(string $uId) {

    }

    public function customerCalendarData(string $uId) {

    }

    public function bookingCalendarData(string $userId) {
        
    }

}
