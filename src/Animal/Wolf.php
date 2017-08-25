<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/25/17
 * Time: 18:17
 */

namespace Animal;

use Interfaces\Actions\Run;
use Interfaces\Actions\Walk;
use Interfaces\Actions\Wuf;

class Wolf extends Animal implements Walk, Run, Wuf
{
    protected $bitePower = 30;

    protected $cutenessLevel = 5;

    protected $biteChance = 5;

    public function run()
    {
        return $this->getName() . ' is running with a face like this: ' . $this->getFaceExpression();
    }

    public function walk()
    {
        return $this->getName() . ' is walking with a face like this: ' . $this->getFaceExpression();
    }

    public function wuf()
    {
        return $this->getName() . ' made \'wuf\' sound with a face like this: ' . $this->getFaceExpression();
    }

}