<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAnnototeHeighlight extends Model
{
    protected $table = 'users_annotote_highlights';
    
    public $timestamps = false;

    protected $fillable = [
        'user_tote_id','comment','identifier','deleted','highlight_text','created_at','updated_at','order'
    ];

    
    public function annotote()
    {
        return $this->belongsTo(UserAnnotote::class,'user_tote_id');
    }

    public function tags()
    {
        return $this->hasMany(AnnotationTag::class, 'annotation_id', 'id');
    }

    public function votes()
    {
        return $this->hasMany(AnnotationVote::class, 'annotation_id', 'id');
    }

}