<?php

namespace App;

use App\Traits\CoveringTrait;
use Illuminate\Database\Eloquent\Model;

class UpperTorso extends Model
{

    use CoveringTrait;

    protected $fillable = [
        'attachment', 'mass'
    ];

    /**
     * The attachments available for the upper torso
     *
     * @var array
     */
    protected $attachments = ["arms", "legs", "wings", "tentacles", "none"];

    /**
     * The creature model
     *
     * @var $creature
     */
    protected $creature;

    /**
     * The attachment
     *
     * @var $theAttachment
     */
    protected $attachment;

    /**
     * get the creature associated with this upper torso
     */
    public function creature()
    {
        return $this->belongsTo('App\Creature', 'creature_id')->withDefault();
    }

    /**
     * get the creatures upper torso attachment
     *
     * @param $creature
     */
    public function getAttachment($creature)
    {
        $this->creature = $creature;
        $this->getRandomAttachment();
        return $this->attachment;
    }

    /**
     * get a random attachment for the upper torso
     *
     */
    public function getRandomAttachment()
    {
        $gtg = false;
        $this->attachment = $this->attachments[mt_rand(0, count($this->attachments) - 1)];
        while (!$gtg) {
            if ($this->checkLimitations()) {
                $gtg = true;
            }
            $this->attachment = $this->attachments[mt_rand(0, count($this->attachments) - 1)];
        }
    }

    /**
     * get the mass for the upper torso attachments
     *
     * @return int
     */
    public function getRandomMass()
    {
        return mt_rand(1, 5);
    }

    /**
     * Determine if any of the available values are not allowed
     */
    private function checkLimitations()
    {
//        @todo : build this out into a service
        if ($this->checkLocomotion()) {
            return true;
        }
        return false;
    }

    private function checkLocomotion()
    {
        $disallowed = config('locomotionRules.not_allowed_attachments.'. $this->creature->locomotion);
        if (in_array($this->attachment, $disallowed, true)) {
            return false;
        }
        return true;
    }
}
