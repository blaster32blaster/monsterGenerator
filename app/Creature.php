<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creature extends Model
{
    protected $fillable = [
        'locomotion', 'torso_id',
    ];

    public function torso()
    {
        return $this->hasOne('App\Torso');
    }

    public function upperTorso()
    {
        return $this->hasOne('App\UpperTorso');
    }

    public function lowerTorso()
    {
        return $this->hasOne('App\LowerTorso');
    }

    public function top()
    {
        return $this->hasOne('App\Top');
    }

    public function bottom()
    {
        return $this->hasOne('App\Bottom');
    }

    public function front()
    {
        return $this->hasOne('App\Front');
    }

    public function back()
    {
        return $this->hasOne('App\Back');
    }

}
