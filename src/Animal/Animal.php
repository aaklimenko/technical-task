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
use Interfaces\Actions\Bite;
use Interfaces\Actions\Eat;
use Interfaces\Behavior;
use Interfaces\OutputStreamer;

/**
 * Class Animal
 *
 * All animals eat and bite
 *
 * Also they all have facial expressions that is affected by their mood
 * @package Animal
 */
abstract class Animal implements Eat, Bite
{
    const FACE_EXPRESSION_HAPPY = ':)';
    const FACE_EXPRESSION_NEUTRAL = ':|';
    const FACE_EXPRESSION_UNHAPPY= ':(';

    /**
     * @var Behavior[]
     */
    private $behaviors = [];

    /**
     * @var string
     */
    private $name = '';

    /**
     * Some animals, humans for example, can output their experiences
     * through some interface (sending sms, for instance)
     * @var OutputStreamer
     */
    private $outputStreamer;

    /**
     * Happiness level can be affected by feeding them
     * @var int
     */
    private $happinessLevel = 0;

    /**
     * Cuteness level affects other animals, humans, for instance
     * @var int
     */
    protected $cutenessLevel = 0;

    /**
     * The damage done by bite
     * @var int
     */
    protected $bitePower = 0;

    /**
     * Animal aggression (less is more aggressive)
     * @var int
     */
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

    /**
     * Bite
     * @param Animal $animal
     * @return string
     */
    public function bite(Animal $animal) :string
    {
        $animal->getScared($this->bitePower);
        return $this->getName() . ' bited ' . $animal->getName();
    }


    /**
     * Send messages using output stream
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

    /**
     * @param int $amount
     */
    protected function increaseHappinessLevel(int $amount = 1)
    {
        $this->happinessLevel += $amount;
    }

    /**
     * @param int $amount
     */
    protected function decreaseHappinessLevel(int $amount = 1)
    {
        $this->happinessLevel -= $amount;
    }

    public function takeFood()
    {
        $this->increaseHappinessLevel();
    }

    /**
     * @param int $amount
     */
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
     * Face expression defined by the mood
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

    /**
     * @param Behavior $behavior
     * @throws BehaviorException
     */
    public function addBehavior(Behavior $behavior)
    {
        $behavior->setSubject($this);

        if(in_array($behavior, $this->behaviors)) {
            throw new BehaviorException('behavior has been already added to ' . get_class($this));
        }

        $this->behaviors[] = $behavior;
    }

    /**
     * Run all behaviors
     * @return iterable
     */
    public function liveItsLife() :iterable {

        foreach ($this->behaviors as $behavior) {
            foreach ($behavior->run() as $action){
                yield $action;
            }
        }
    }

    /**
     * @return int
     */
    public function getCutenessLevel()
    {
        return $this->cutenessLevel;
    }

}