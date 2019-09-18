<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class TagType extends Model
{
    protected $table = 'tag_types';
    
    public $timestamps = false;

    public function tagType(){
        return $this->hasMany(AnnotationTag::class, 'tag_id', 'id');
    }
}

