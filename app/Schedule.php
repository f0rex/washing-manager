<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function setScheduledAtAttribute($value)
    {
        if ($value == NULL) {
            $this->attributes['scheduled_at'] = NULL;
        } else {
            $this->attributes['scheduled_at'] = $value->toDateString();
        }
    }

    public function setWashedAtAttribute($value)
    {
        if ($value == NULL) {
            $this->attributes['washed_at'] = NULL;
        } else {
            $this->attributes['washed_at'] = $value->toDateString();
        }
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }
}
