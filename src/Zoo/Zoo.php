<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/25/17
 * Time: 19:03
 */

namespace Zoo;


use Animal\Animal;
use Animal\Human\Human;
use Exception\InvalidConfigException;
use Interfaces\Behavior;
use Interfaces\ZooTransport;

class Zoo
{
    /**
     * @var Human[]
     */
    private $visitors;

    /**
     * @var Animal []
     */
    private $animals;

    /**
     * @var ZooTransport
     */
    private $zooTransport;

    /**
     * Zoo constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->initAnimals($config);

        $this->initZooTransport($config);
    }

    /**
     * Add visitor to zoo
     * @param Human $human
     */
    public function addVisitor(Human $human)
    {
        $this->visitors[] = $human;
    }

    /**
     * Take each visitor to each animal using zoo transport
     */
    public function run()
    {
        foreach ($this->animals as $animal) {
            $this->zooTransport->addAnimalToRoute($animal);
        }

        foreach ($this->visitors as $human) {
            $this->zooTransport->setVisitor($human);
            $this->zooTransport->runTheRoute();
        }
    }

    /**
     * Init zoo transport
     * @param array $config
     * @throws InvalidConfigException
     */
    private function initZooTransport(array $config)
    {
        if(!isset($config['zooTransport']) || !isset($config['zooTransport']['class'])){
            throw new InvalidConfigException('invalid config for zooTransport');
        }

        $zooTransport = new $config['zooTransport']['class']();

        if(!($zooTransport instanceof ZooTransport)) {
            throw new InvalidConfigException('invalid config for zooTransport');
        }

        $this->zooTransport = $zooTransport;
    }

    /**
     * Init all animals
     * @param array $config
     * @throws InvalidConfigException
     */
    private function initAnimals(array $config)
    {
        if(!isset($config['animals'])) {
            throw new InvalidConfigException('no attribute "animals" in config file');
        }

        foreach ($config['animals'] as $name => $animalConfig) {

            if(!isset($animalConfig['class'])){
                throw new InvalidConfigException("no class defined for animal {$name}");
            }

            $animal = new $animalConfig['class']($name);

            if(!($animal instanceof Animal)) {
                throw new InvalidConfigException("invalid class for animal {$name}");
            }

            if(isset($animalConfig['behaviours'])) {
                foreach ($animalConfig['behaviours'] as $behaviourClass) {

                    $behavior = new $behaviourClass();

                    if(!($behavior instanceof Behavior)) {
                        throw new InvalidConfigException("invalid behavior class for {$name}");
                    }

                    $animal->addBehavior($behavior);
                }
            }

            $this->animals[] = $animal;
        }
    }
}