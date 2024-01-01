<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserConfig extends Model {
    protected $table = 'test123.user_config';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable =  [
        'user_id', 'is_activate', 'is_default_coach', 'is_sync_calendar',
        'google_auth_code', 'picture'
    ];
}
