<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/27/17
 * Time: 23:03
 */

namespace Tests;


use Animal\Zebra;

class ZebraMock extends Zebra
{
    public static $fixtures = [
        'walk mock',
        'run mock'
    ];

    public function run()
    {
        return static::$fixtures[1];
    }

    public function walk()
    {
        return static::$fixtures[0];
    }
}