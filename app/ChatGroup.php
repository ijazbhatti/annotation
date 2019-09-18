<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatGroup extends Model
{
    protected $table = 'chat_groups';
    
    public $timestamps = false;

    public function userGroup()
    {
        return $this->hasMany(UserGroup::class, 'group_id', 'id');
    }

    public function userMessage()
    {
        return $this->hasMany(Message::class, 'group_id', 'id');
    }

    public function meNotification()
    {
        return $this->hasMany(MeNotification::class, 'group_id', 'id');
    }
}

