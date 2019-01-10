<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingParticipant extends Model
{
    protected function hour() {
        return $this->belongsTo('App\MeetingHour');
    }
}
