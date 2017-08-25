<?php

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/vendor/autoload.php';

$human = new \Animal\Human\Human('Bill', new \Output\SMSCommunication());

$zooGolfCar = new \Zoo\ZooGolfCar($human);

$zebra = new \Animal\Zebra('Zebra');
$zebra->addBehavior(new \Animal\AnimalBehavior\ZebraBehavior());

$wolf = new \Animal\Wolf('Wolf');
$wolf->addBehavior(new \Animal\AnimalBehavior\WolfBehavior());

$zooGolfCar->addAnimalToRoute($wolf);
$zooGolfCar->addAnimalToRoute($zebra);

$zooGolfCar->runTheRoute();