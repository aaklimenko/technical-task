<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/25/17
 * Time: 17:15
 */

namespace Animal\Human;


use Animal\Animal;

class Human extends Animal
{
    /**
     * Human interaction scenario with each animal
     * @param Animal $animal
     * @return string
     */
    public function startInteractionRoutine(Animal $animal) :string
    {
        $this->writeSMS("\nHi, its {$this->getName()}");
        $this->writeSMS("I'm looking at {$animal->getName()}");

        $this->observeAnimal($animal);
        $this->feedAnimal($animal);
        $this->observeAnimal($animal);
        $this->increaseHappinessLevel($animal->getCutenessLevel());

        /**
         * Human let an animal interact with him/her and writes about the experience.
         */
        $this->writeSMS($animal->startInteractionRoutine($this));

        $this->notifyAboutMood();

        return $this->getFaceExpression();
    }

    /**
     * Output observed behavior
     * @param string $message
     */
    protected function writeSMS(string $message)
    {
        $this->stream($message);
    }

    /**
     * Observe animal behavior
     * @param Animal $animal
     */
    private function observeAnimal(Animal $animal)
    {
        foreach ($animal->liveItsLife() as $observation)
        {
            $this->writeSMS($observation);
        }
    }

    private function notifyAboutMood()
    {
        $this->writeSMS('I\'m feeling ' . $this->getFaceExpression());
    }

    /**
     * @param Animal $animal
     */
    private function feedAnimal(Animal $animal)
    {
        $animal->takeFood();
        $this->writeSMS('I\'ve just given food to ' . $animal->getName());
    }


}