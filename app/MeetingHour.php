<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingHour extends Model
{
    protected function day() {
        return $this->belongsTo('App\MeetingDay');
    }
}
