<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    protected $table = 'test123.user';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public $incrementing = false;
    protected $keyType = 'string';



    protected $fillable =  [
        'name', 'email', 'create_time'
    ];

}
