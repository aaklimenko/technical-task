<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/25/17
 * Time: 18:17
 */

namespace Animal;


class Wolf extends Animal
{
    protected $bitePower = 10;

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