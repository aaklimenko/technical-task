<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/25/17
 * Time: 19:00
 */

return [
   'animals' => [
       'Zebra' => [
           'class' => \Animal\Zebra::class,
           'behaviours' => [\Animal\AnimalBehavior\ZebraBehavior::class]
       ],
       'Wolf' => [
           'class' => \Animal\Wolf::class,
           'behaviours' => [\Animal\AnimalBehavior\WolfBehavior::class]
       ],
   ],
    'zooTransport' => [
        'class' => \Zoo\ZooGolfCar::class
    ]
];