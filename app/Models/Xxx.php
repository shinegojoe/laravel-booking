<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class XXX extends Model {
    protected $table = 'test123.xxx';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable =  [
        'name'
    ];

}