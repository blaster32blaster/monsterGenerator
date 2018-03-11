<?php

namespace App;

use App\Traits\CoveringTrait;
use Illuminate\Database\Eloquent\Model;

/**
 */
class Torso extends Model
{

    use CoveringTrait;

    protected $fillable = [
        'color', 'covering', 'pattern',
    ];

    /**
     * The available covering values
     *
     * @var array
     */
    protected $coverings = ["skin", "feathers", "scales", "slime", "skin", "non-corporeal", "skeletonized", "fur", "spines", "skin", "fire", "water", "earth", "air"];

    /**
     * The main covering that will determine the allowable values for sub Coverings
     *
     * @var $mainCovering
     */
    protected $mainCovering;

    /**
     * The actual applied levels of all coverings
     *
     * @var $coverings
     */
    protected $appliedCoverings;

    /**
     * Value available for distribution
     *
     * @var $availVal
     */
    protected $availVal = 80;


    /**
     * Associates torso with creature
     */
    public function creature()
   {
       return $this->belongsTo('App\Creature', 'creature_id')->withDefault();
   }

    /**
     * get the torso coloring
     *
     * @return mixed
     */
    public function getRandomColor()
   {
       $colors = ["AliceBlue","AntiqueWhite","Aqua","Aquamarine","Azure","Beige","Bisque","Black","BlanchedAlmond","Blue","BlueViolet","Brown","BurlyWood","CadetBlue","Chartreuse","Chocolate","Coral","CornflowerBlue","Cornsilk","Crimson","Cyan","DarkBlue","DarkCyan","DarkGoldenRod","DarkGray","DarkGrey","DarkGreen","DarkKhaki","DarkMagenta","DarkOliveGreen","Darkorange","DarkOrchid","DarkRed","DarkSalmon","DarkSeaGreen","DarkSlateBlue","DarkSlateGray","DarkSlateGrey","DarkTurquoise","DarkViolet","DeepPink","DeepSkyBlue","DimGray","DimGrey","DodgerBlue","FireBrick","FloralWhite","ForestGreen","Fuchsia","Gainsboro","GhostWhite","Gold","GoldenRod","Gray","Grey","Green","GreenYellow","HoneyDew","HotPink","IndianRed","Indigo","Ivory","Khaki","Lavender","LavenderBlush","LawnGreen","LemonChiffon","LightBlue","LightCoral","LightCyan","LightGoldenRodYellow","LightGray","LightGrey","LightGreen","LightPink","LightSalmon","LightSeaGreen","LightSkyBlue","LightSlateGray","LightSlateGrey","LightSteelBlue","LightYellow","Lime","LimeGreen","Linen","Magenta","Maroon","MediumAquaMarine","MediumBlue","MediumOrchid","MediumPurple","MediumSeaGreen","MediumSlateBlue","MediumSpringGreen","MediumTurquoise","MediumVioletRed","MidnightBlue","MintCream","MistyRose","Moccasin","NavajoWhite","Navy","OldLace","Olive","OliveDrab","Orange","OrangeRed","Orchid","PaleGoldenRod","PaleGreen","PaleTurquoise","PaleVioletRed","PapayaWhip","PeachPuff","Peru","Pink","Plum","PowderBlue","Purple","Red","RosyBrown","RoyalBlue","SaddleBrown","Salmon","SandyBrown","SeaGreen","SeaShell","Sienna","Silver","SkyBlue","SlateBlue","SlateGray","SlateGrey","Snow","SpringGreen","SteelBlue","Tan","Teal","Thistle","Tomato","Turquoise","Violet","Wheat","White","WhiteSmoke","Yellow","YellowGreen"];
       $color = $colors[mt_rand(0, count($colors)-1)];

       return $color;
   }

    /**
     * call the methods that will determine torso composition
     *
     * @return mixed
     */
    public function getCoveringValues()
    {
        $this->getMainCovering();
        $this->applyLevelsToCovering();

        return $this->appliedCoverings;
    }

    /**
     * get the torso external pattern
     *
     * @return mixed
     */
    public function getRandomPattern()
    {
        $patterns = ["none", "stripes", "spotted", "none", "none"];
        $pattern = $patterns[mt_rand(0, count($patterns)-1)];

        return $pattern;
    }

    /**
     * get a random torso composition
     *
     * @return mixed
     */
    public function getRandomCovering()
    {
        return $this->coverings[mt_rand(0, count($this->coverings)-1)];
    }

    /**
     * this is the main torso composition, this will have a higher value than others
     */
    public function getMainCovering()
    {
        $this->mainCovering = $this->coverings[mt_rand(0, count($this->coverings)-1)];
    }

    /**
     * this will set the varying torso composition levels
     */
    public function applyLevelsToCovering()
    {
        $cover = [];
        $cover[$this->mainCovering] = 20;

        while ($this->availVal > 0) {
            $cov = $this->getRandomCovering();
                if ($cov !== $this->mainCovering) {
                    if ((isset($cover[$cov]) && $cover[$cov] < 15) || !isset($cover[$cov])) {
                        $val = $this->getVal();
                        $val = $this->disallowPointOverSpending($val);
                        $cover = $this->initializeNewEntities($cover, $cov);

                        if ($cover[$cov] + $val > 15) {
                            $val = $val - (($cover[$cov] + $val) - 15);
                        }
                        $cover[$cov] += $val;

                        $this->availVal -= $val;
                    }
                }
        }
        $this->appliedCoverings = $cover;
    }

    /**
     * get a random value for assigning to torso composition
     *
     * @return int
     */
    public function getVal()
    {
        return mt_rand(1, 15);
    }

    /**
     * do not allow points to be applied if the points are not available
     *
     * @param $val
     *
     * @return int
     */
    protected function disallowPointOverSpending($val)
    {
        if ($val > $this->availVal) {
            $val = $this->availVal;
        }
        return $val;
    }

    /**
     * if the value has not been previously set, ensure that it is
     *
     * @param $cover
     * @param $val
     *
     * @return mixed
     */
    protected function initializeNewEntities($cover, $val)
    {
        if (!isset($cover[$val])) {
            $cover[$val] = 0;
        }
        return $cover;
    }


    /**
     * mutate to ensure an array is returned
     *
     * @param $value
     *
     * @return array
     */
    public function getCovering($value)
    {
        return (array)$value;
    }
}
