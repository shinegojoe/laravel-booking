<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model {
    protected $table = 'test123.payment_history';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable =  [
        'course_id', 'create_time', 'price', 'user_id',
        'point', 'comment'
    ];
}
