<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/25/17
 * Time: 18:18
 */

namespace Animal\AnimalBehavior;


use Animal\Animal;
use Animal\Wolf;
use Interfaces\Behavior;

class WolfBehavior implements Behavior
{
    /**
     * @var Wolf
     */
    private $subject;

    /**
     * Wolf behavior
     * @return iterable
     */
    public function run() :iterable {
        yield $this->subject->walk();
        yield $this->subject->run();
        yield $this->subject->wuf();
    }

    public function setSubject(Animal $subject)
    {
        $this->subject = $subject;
    }
}