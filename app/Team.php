<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

	 /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

   function players() {
        return $this->hasMany('App\Player');
    }
}
