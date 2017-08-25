<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/25/17
 * Time: 15:46
 */

namespace Animal;


use Exception\BehaviorException;
use Exception\NoOutputStreamException;
use Interfaces\Actions\Eat;
use Interfaces\Behavior;
use Interfaces\OutputStreamer;

abstract class Animal implements Eat
{
    const FACE_EXPRESSION_HAPPY = ':)';
    const FACE_EXPRESSION_NEUTRAL = ':|';
    const FACE_EXPRESSION_UNHAPPY= ':(';

    /**
     * @var OutputStreamer
     */
    private $outputStreamer;

    /**
     * @var Behavior[]
     */
    private $behaviors = [];

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var int
     */
    private $happinessLevel = 0;

    protected $cutenessLevel = 0;

    protected $bitePower = 0;
    protected $biteChance = 0;

    /**
     * Animal constructor.
     * @param string|null $name
     * @param OutputStreamer|null $outputStreamer
     */
    public function __construct(string $name = null, OutputStreamer $outputStreamer = null)
    {
        $this->name = $name;
        $this->outputStreamer = $outputStreamer;
    }

    /**
     * When an animal interacts with an other animal
     * there's always a chance of an other animal
     * being bited. Not all animals are aggressive so
     * this is a probabilistic interaction
     *
     * @param Animal $animal
     * @return string
     */
    public function startInteractionRoutine(Animal $animal) :string
    {
        if(rand(1, $this->biteChance) === 1) {
            return $this->bite($animal);
        }

        return $this->getName() . ' is behaving good';
    }

    public function bite(Animal $animal) :string
    {
        $animal->getScared($this->bitePower);
        return $this->getName() . ' bited ' . $animal->getName();
    }


    /**
     * @param string $message
     * @throws NoOutputStreamException
     */
    protected function stream(string $message)
    {
        if(!$this->outputStreamer) {
            throw new NoOutputStreamException('No output streamer initialized for instance of ' . get_class($this));
        }

        $this->outputStreamer->stream($message);
    }

    protected function increaseHappinessLevel(int $amount = 1)
    {
        $this->happinessLevel += $amount;
    }

    protected function decreaseHappinessLevel(int $amount = 1)
    {
        $this->happinessLevel -= $amount;
    }

    public function takeFood()
    {
        $this->increaseHappinessLevel();
    }

    public function getScared(int $amount)
    {
        $this->decreaseHappinessLevel($amount);
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName() :string
    {
        return $this->name;
    }

    /**
     * @param OutputStreamer $outputStreamer\
     */
    public function setOutputStreamer(OutputStreamer $outputStreamer)
    {
        $this->outputStreamer = $outputStreamer;
    }

    /**
     * @return string
     */
    public function getFaceExpression() :string
    {
        if($this->happinessLevel == 0) {

            return Animal::FACE_EXPRESSION_NEUTRAL;

        } elseif ($this->happinessLevel > 0) {

            return Animal::FACE_EXPRESSION_HAPPY;

        }

        return Animal::FACE_EXPRESSION_UNHAPPY;
    }

    public function addBehavior(Behavior $behavior)
    {
        $behavior->setSubject($this);

        if(in_array($behavior, $this->behaviors)) {
            throw new BehaviorException('behavior has been already added to ' . get_class($this));
        }

        $this->behaviors[] = $behavior;
    }

    public function liveItsLife() :iterable {

        foreach ($this->behaviors as $behavior) {
            foreach ($behavior->run() as $action){
                yield $action;
            }
        }
    }

    public function getCutenessLevel()
    {
        return $this->cutenessLevel;
    }

}