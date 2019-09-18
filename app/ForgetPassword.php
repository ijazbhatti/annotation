<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ForgetPassword extends Model
{
    protected $table = 'forget_passwords';
    
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
