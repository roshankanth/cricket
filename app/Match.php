<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    
   function points() {
        return $this->hasMany('App\Point','match_id');
    }


    function playerHistory() {
        return $this->hasMany('App\PlayerHistory','match_id');
    }


    
}
