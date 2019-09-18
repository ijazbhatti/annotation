<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Billable;

    protected $table = 'users';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function verifiedUser()
    {
        return $this->hasOne(UserVerification::class, 'user_id', 'id');
    }
    public function userTags()
    {
        return $this->hasMany(UserTag::class, 'user_id');
    }

    public function forgetPasswordToken()
    {
        return $this->hasOne(ForgetPassword::class, 'user_id', 'id');
    }

    public function logedInUser()
    {
        return $this->hasMany(LoginUser::class, 'user_id', 'id');
    }

    public function annotote()
    {
        return $this->hasMany(UserAnnotote::class, 'user_id', 'id');
    }

    public function followers(){
        return $this->belongsToMany(User::class,'followers','follows_id','follower_id');
    }

    public function follows(){
        return $this->belongsToMany(User::class,'followers','follower_id','follows_id');
    }

    public function search()
    {
        return $this->hasMany(SavedSearch::class, 'user_id', 'id');
    }


    public function senderNotification()
    {
        return $this->hasMany(Notification::class, 'sender_id', 'id');
    }


    public function receiverNotification()
    {
        return $this->hasMany(Notification::class, 'receiver_id', 'id');
    }



    public function group()
    {
        return $this->hasMany(UserGroup::class, 'user_id', 'id');
    }

    public function userMessage()
    {
        return $this->hasMany(Message::class, 'sender_id', 'id');
    }
}

