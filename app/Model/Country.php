<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function state() {
    	return $this->hasMany('App\Model\State');
    }
}