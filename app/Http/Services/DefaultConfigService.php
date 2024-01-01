<?php
namespace App\Http\Services;
use App\Models\DefaultConfig;

class DefaultConfigService {
    public function __construct() {

    }

    public function getByCourseId(string $courseId) {
        $data = DefaultConfig::where("course_id", $courseId)->first();
        return $data;
    }

    public function update(DefaultConfig $body) {
        DefaultConfig::where("id", $body->id)->update($body);
    }

    public function create(DefaultConfig $body) {
        $data = DefaultConfig::create($body);
        return $data;
    }


}
