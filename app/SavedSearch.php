<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class SavedSearch extends Model
{
    protected $table = 'saved_searches';
    
    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

