<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/27/17
 * Time: 23:04
 */

namespace Tests;


use Animal\AnimalBehavior\ZebraBehavior;
use PHPUnit\Framework\TestCase;

class ZebraBehaviorTest extends TestCase
{
    /**
     * @var ZebraBehavior
     */
    private $zebraBehavior;

    public function setUp()
    {
        $zebraMock = new ZebraMock();
        $this->zebraBehavior = new ZebraBehavior();
        $this->zebraBehavior->setSubject($zebraMock);
        parent::setUp();
    }

    public function testBehavior()
    {
        foreach ($this->zebraBehavior->run() as $key => $observation)
        {
            $this->assertEquals(ZebraMock::$fixtures[$key], $observation);
        }
    }

}