<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnototeBookmark extends Model
{
    protected $table = 'annotote_bookmarks';
    
    public $timestamps = false;

    protected $fillable = [
        'user_id','user_tote_id','created_at','updated_at'
    ];

}

