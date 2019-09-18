<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnotationVote extends Model
{
    protected $table = 'annotation_votes';
    
    public $timestamps = false;

    protected $fillable = [
        'user_id','annotation_id','vote','created_at','updated_at'
    ];


    public function annotation(){
        return $this->belongsTo(UserAnnototeHeighlight::class, 'annotation_id');
    }

}

