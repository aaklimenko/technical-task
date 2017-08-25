<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/25/17
 * Time: 15:53
 */

namespace Output;


use Interfaces\OutputStreamer;

class StdOutStreamer implements OutputStreamer
{
    public function stream(string $message)
    {
        echo $message . "\n";
    }
}