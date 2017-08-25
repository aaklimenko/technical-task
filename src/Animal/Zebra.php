<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/25/17
 * Time: 16:21
 */

namespace Animal;

use Interfaces\Actions\Run;
use Interfaces\Actions\Walk;

class Zebra extends Animal implements Run, Walk
{
    protected $bitePower = 5;

    protected $biteChance = 10;

    protected $cutenessLevel = 20;

    public function run()
    {
        return $this->getName() . ' is running with a face like this: ' . $this->getFaceExpression();
    }

    public function walk()
    {
        return $this->getName() . ' is walking with a face like this: ' . $this->getFaceExpression();
    }
}