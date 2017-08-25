<?php

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/vendor/autoload.php';

$zooConfig = require __DIR__ . '/src/Config/zooConfig.php';

use Zoo\Zoo;
use Animal\Human\Human;
use Output\SMSCommunication;

$communicationInterface = new SMSCommunication();

$zoo = new Zoo($zooConfig);

$zoo->addVisitor(new Human('Bill', $communicationInterface));
$zoo->addVisitor(new Human('Andrew', $communicationInterface));
$zoo->addVisitor(new Human('Sarah', $communicationInterface));
$zoo->addVisitor(new Human('Barbara', $communicationInterface));
$zoo->addVisitor(new Human('Alex', $communicationInterface));

$zoo->run();