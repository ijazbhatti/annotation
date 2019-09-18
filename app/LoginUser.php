<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginUser extends Model
{
    protected $table = 'login_users';
    
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

