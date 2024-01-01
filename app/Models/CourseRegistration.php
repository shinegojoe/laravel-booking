<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseRegistration extends Model {
    protected $table = 'test123.course_registration';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable =  [
        'course_id', 'create_time', 'point', 'user_id'
    ];

}
