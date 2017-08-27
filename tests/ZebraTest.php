<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/27/17
 * Time: 22:50
 */
namespace Tests;

use Animal\Animal;

class ZebraTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Animal\Zebra
     */
    private $zebra;

    private $fixtures = [
        'name' => 'Zebra'
    ];

    public function setUp()
    {
        $this->zebra = new \Animal\Zebra($this->fixtures['name']);
        parent::setUp();
    }

    public function testWalk()
    {
        $this->assertEquals($this->zebra->walk(), $this->fixtures['name'] . ' is walking with a face like this: :|');
    }

    public function testRun()
    {
        $this->assertEquals($this->zebra->run(), $this->fixtures['name'] . ' is running with a face like this: :|');
    }

    public function testFeed()
    {
        $this->zebra->takeFood();
        $this->assertEquals($this->zebra->getFaceExpression(),  Animal::FACE_EXPRESSION_HAPPY);
    }

    public function testScare()
    {
        $this->zebra->getScared(10);
        $this->assertEquals($this->zebra->getFaceExpression(),  Animal::FACE_EXPRESSION_UNHAPPY);
    }
}