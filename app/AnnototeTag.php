<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnototeTag extends Model
{
    protected $table = 'annotote_tags';
    
    public $timestamps = false;

    protected $fillable = [
        'user_tote_id','tag_text','created_at','updated_at'
    ];

    public function annotote()
    {
        return $this->belongsTo(UserAnnotote::class,'user_tote_id');
    }

}

