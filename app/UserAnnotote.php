<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAnnotote extends Model
{
    protected $table = 'users_annototes';
    
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function annotote()
    {
        return $this->belongsTo(Annotote::class,'annotote_id');
    }

    public function annototeHeighlight()
    {
        return $this->hasMany(UserAnnototeHeighlight::class, 'user_tote_id', 'id');
    }


    public function annototeTags()
    {
        return $this->hasMany(AnnototeTag::class, 'user_tote_id', 'id');
    }


    public function meNotification()
    {
        return $this->hasMany(MeNotification::class, 'chat_group_id', 'id');
    }

    public function annototeVotes()
    {
        return $this->hasMany(AnnototeVote::class, 'user_tote_id', 'id');
    }


    public function Saves()
    {
        return $this->hasMany(AnnototeSave::class, 'user_tote_id', 'id');
    }

}
