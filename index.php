<?php

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/vendor/autoload.php';

/**
 * Our Zoo config. Visitors are external objects in relation to the zoo,
 * so it makes sense to init them separately. An other fabric for visitors would work well,
 * but it looks good enough like this, as it is just a showcase.
 */
$zooConfig = require __DIR__ . '/src/Config/zooConfig.php';

use Zoo\Zoo;
use Animal\Human\Human;
use Output\SMSCommunication;

/**
 * An interface through which our visitors communicate with outside world.
 * By legend it's SMS messages. Basically it's just stdOut.
 */
$communicationInterface = new SMSCommunication();

$zoo = new Zoo($zooConfig);

$zoo->addVisitor(new Human('Bill', $communicationInterface));
$zoo->addVisitor(new Human('Andrew', $communicationInterface));
$zoo->addVisitor(new Human('Sarah', $communicationInterface));
$zoo->addVisitor(new Human('Barbara', $communicationInterface));
$zoo->addVisitor(new Human('Alex', $communicationInterface));

$zoo->run();