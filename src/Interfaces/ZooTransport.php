<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/25/17
 * Time: 19:06
 */

namespace Interfaces;


use Animal\Animal;
use Animal\Human\Human;

interface ZooTransport
{
    public function addAnimalToRoute(Animal $animal);

    public function runTheRoute();

    public function setVisitor(Human $human);
}