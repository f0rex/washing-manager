<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function vehicles()
    {
        return $this->hasMany('App\Vehicle');
    }
}
