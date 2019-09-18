<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class MeNotification extends Model
{
    protected $table = 'me_notification';
    
    public $timestamps = false;

    public function chatGroup()
    {
        return $this->belongsTo(ChatGroup::class,'chat_group_id');
    }

    public function userAnnotote()
    {
        return $this->belongsTo(UserAnnotote::class,'user_tote_id');
    }


}