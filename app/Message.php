<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    
    public $timestamps = false;

    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id');
    }

    public function group()
    {
        return $this->belongsTo(ChatGroup::class,'group_id');
    }
}

