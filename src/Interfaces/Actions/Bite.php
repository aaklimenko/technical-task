<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/25/17
 * Time: 16:32
 */

namespace Interfaces\Actions;


use Animal\Animal;

interface Bite
{
    public function bite(Animal $animal);
}