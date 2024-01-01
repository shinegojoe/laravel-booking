<?php
namespace App\Http\Services;
use App\Utils\TableNameString;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


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

}
