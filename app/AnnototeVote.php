<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnototeVote extends Model
{
    protected $table = 'annotote_votes';
    
    public $timestamps = false;

    protected $fillable = [
        'user_id','user_tote_id','vote', 'created_at','updated_at'
    ];

    public function annotote()
    {
        return $this->belongsTo(UserAnnotote::class,'user_tote_id');
    }

}

