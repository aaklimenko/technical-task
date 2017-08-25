<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/25/17
 * Time: 17:28
 */

namespace Animal\AnimalBehavior;

use Animal\Animal;
use Animal\Zebra;
use Interfaces\Behavior;

class ZebraBehavior implements Behavior
{
    /**
     * @var Zebra
     */
    private $subject;

    /**
     * Zebra behavior
     */
    public function run() :iterable {
        yield $this->subject->walk();
        yield $this->subject->run();
    }

    public function setSubject(Animal $subject)
    {
        $this->subject = $subject;
    }
}