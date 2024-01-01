<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {
    protected $table = 'test123.booking';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable =  [
        'course_id', 'date_str', 'start_date', 'end_date',
        'state', 'user_id', 'coach_comment', 'customer_comment'
    ];

}
