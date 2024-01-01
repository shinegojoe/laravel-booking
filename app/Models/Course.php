<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Log;


class Course extends Model
{
    protected $table = 'test123.course';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public $incrementing = false;
    protected $keyType = 'string';



    protected $fillable =  [
        'user_id', 'name', 'create_time', 'is_activate'
    ];



    public function getUserIdAttribute()
    {
        return $this->attributes['user_id'];
    }

    /**
     * Set the value of the "testName" attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = $value;
    }




    // public function getUIdAttr() {
    //     return $this->attributes['user_id'];
    // }

    // public function serUIdAttr($value) {
    //     $this->attributes['user_id'] = $value;
    // }


}
