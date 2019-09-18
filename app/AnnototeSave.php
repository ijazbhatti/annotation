<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnototeSave extends Model
{
    protected $table = 'annotote_saves';
    
    public $timestamps = false;

    protected $fillable = [
        'user_id','user_tote_id','created_at','updated_at'
    ];

    public function annotote()
    {
        return $this->belongsTo(UserAnnotote::class,'user_tote_id');
    }

}

