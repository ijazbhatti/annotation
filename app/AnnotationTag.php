<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnotationTag extends Model
{
    protected $table = 'annotation_tags';
    
    public $timestamps = false;

    protected $fillable = [
        'tag_id','annotation_id','tag_text','link','created_at','updated_at'
    ];

    public function tagType(){
        return $this->belongsTo(TagType::class, 'tag_id');
    }

    public function annotation(){
        return $this->belongsTo(UserAnnototeHeighlight::class, 'annotation_id');
    }

}

