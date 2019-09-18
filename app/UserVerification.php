<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVerification extends Model
{
    protected $table = 'users_verification';
    
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}

