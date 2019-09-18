<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAnnototeTag extends Model
{
    protected $table = 'user_tote_tags';
    
    public $timestamps = false;

    public function tagType(){
        return $this->belongsTo(TagType::class, 'tag_id');
    }

}

