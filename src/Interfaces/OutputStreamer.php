<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/25/17
 * Time: 15:52
 */

namespace Interfaces;


interface OutputStreamer
{
    public function stream(string $message);
}