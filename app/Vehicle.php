<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    public function setLastWashedInternallyAtAttribute($value)
    {
        if ($value == NULL) {
            $this->attributes['last_washed_internally_at'] = NULL;
        } else {
            $this->attributes['last_washed_internally_at'] = $value->toDateString();
        }
    }

    public function setLastWashedExternallyAtAttribute($value)
    {
        if ($value == NULL) {
            $this->attributes['last_washed_externally_at'] = NULL;
        } else {
            $this->attributes['last_washed_externally_at'] = $value->toDateString();
        }
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }
}
