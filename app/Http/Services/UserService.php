<?php
namespace App\Http\Services;
use App\Models\User;
use App\Utils\TableNameString;
use Illuminate\Support\Facades\DB;
use App\Utils\BodyHelper;
Use App\Entity\User as UserEntity;



class UserService {

    private string $userTable;
    private string $bookingTable;
    public function __construct(TableNameString $tableNameString) {
       $this->userTable = $tableNameString::user;
       $this->bookingTable = $tableNameString::booking;
    }

  

    public function listByCourseId(string $courseId) {
        $sql = "select * from $this->userTable u inner join (select user_id from $this->bookingTable where course_id = ? group by user_id ) temp123  on u.id=temp123.user_id";
        $data = DB::select($sql, [$courseId]);
        return $data;
    }

    public function get(string $uId) {
        $data = User::find($uId);
        return $data; 
    }

    public function findByEmail(string $email) {
        $data = User::where("email", $email)->first();
        return $data;
    }


    public function create(UserEntity $body) {
        $body = (array) $body;
        $body = BodyHelper::toSnake($body);
        $data = User::create($body);
        return $data;
    }
}
