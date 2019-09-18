<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Annotote extends Model
{
    protected $table = 'annototes';
    
    public $timestamps = false;

    public function userAnnotote()
    {
        return $this->hasMany(UserAnnotote::class, 'annotote_id', 'id');
    }
}

