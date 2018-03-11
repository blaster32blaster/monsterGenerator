<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creature extends Model
{
    protected $fillable = [
        'locomotion', 'mass',
    ];

    /**
     * The values available for locomotion
     *
     * @var array
     */
    protected $locomotionTypes = ["bipedal", "quadripedal", "slither", "flying", "swimming", "vacuum"];

    /**
     * The locomotion for the creature
     *
     * @var $locomotion
     */
    protected $locomotion;

    public function torso()
    {
        return $this->hasOne('App\Torso' ,'creature_id', 'id');
    }

    public function upperTorso()
    {
        return $this->hasOne('App\UpperTorso' ,'creature_id', 'id');
    }

    public function lowerTorso()
    {
        return $this->hasOne('App\LowerTorso','creature_id', 'id');
    }

    public function top()
    {
        return $this->hasOne('App\Top','creature_id', 'id');
    }

    public function bottom()
    {
        return $this->hasOne('App\Bottom','creature_id', 'id');
    }

    public function front()
    {
        return $this->hasOne('App\Front','creature_id', 'id');
    }

    public function back()
    {
        return $this->hasOne('App\Back','creature_id', 'id');
    }

    public function getRandomMass()
    {
        return mt_rand(10, 1000);
    }

    public function getRandomLocomotion()
    {
        return $this->locomotionTypes[mt_rand(0, count($this->locomotionTypes)-1)];
    }
}
