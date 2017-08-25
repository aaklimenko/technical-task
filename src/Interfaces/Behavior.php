<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/25/17
 * Time: 16:21
 */

namespace Interfaces;


use Animal\Animal;

interface Behavior
{
    public function run() :iterable;
    public function setSubject(Animal $animal);
}