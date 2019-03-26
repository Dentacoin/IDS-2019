<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    protected function media() {
        return $this->belongsTo('App\Media');
    }
}
