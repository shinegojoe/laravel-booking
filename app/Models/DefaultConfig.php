<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DefaultConfig extends Model {
    protected $table = 'test123.default_config';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable =  [
        'course_id', 'start', 'end', 'interval',
        'close_days', 'close_times'
    ];
}
