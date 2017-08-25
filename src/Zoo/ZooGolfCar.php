<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/25/17
 * Time: 17:16
 */
namespace  Zoo;

use Animal\Animal;
use Animal\Human\Human;
use Exception\ZooRouteException;
use Interfaces\ZooTransport;

class ZooGolfCar implements ZooTransport
{
    /**
     * @var Human
     */
    private $human;

    /**
     * @var Animal[]
     */
    private $zooRoute = [];

    public function setVisitor(Human $human)
    {
        $this->human = $human;
    }

    public function addAnimalToRoute(Animal $animal)
    {
        if(in_array($animal, $this->zooRoute)){
            throw new ZooRouteException('According to zoo rules you can only have one visit per animal');
        }

        $this->zooRoute[] = $animal;
    }

    public function runTheRoute()
    {
        foreach ($this->zooRoute as $animal) {
            $this->human->startInteractionRoutine($animal);
        }
    }
}