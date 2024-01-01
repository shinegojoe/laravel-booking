<?php
namespace App\Http\Services;
use App\Models\Course;


class CourseService {
    public function __construct() {

    }

    public function findById(string $id) {
        $course = Course::where("id", $id)->first();
        return $course;
    }

    public function update(Course $body) {
        return Course::where("id", $body->id)->update($body);
    }

    public function getByCourseId(string $courseId) {
        $data = Course::where("course_id", $courseId)->first();
        return $data;
    }

    public function create(Course $body) {
        $data = Course::create($body);
        return $data;
    }

    public function listByCoachId(string $uId) {
        $data = Course::where("course_id", $uId)->first();
        return $data;
    }

    public function listByClientId(string $clientId) {
        $data = Course::where("client_id", 4)->first();
        return $data;
    }

    // public function deactivate(Course $body) {
    //     $data = Course::where("id", $body->id)->update($body);
    //     return $data;
    // }
}
