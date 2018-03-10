<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpperTorso extends Model
{
    public function creature()
    {
        return $this->belongsTo('App\Creature')->withDefault();
    }
}
