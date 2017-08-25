##Amadeus It Group PHP Developer Technical Task. Alex Klimenko

## Overview

Initial task was pretty trivial, so I decided to add some complexity to it :)

The legend: a person goes to the zoo and sends SMS messages to his/her spouse about
everything he/she observes there. The zoo has a golf car that drives visitors to
all animals. Animals cannot "send messages", only display(yield) their behaviour. 
A visitor observes behaviors displayed by animals and sends everything using SMS (stdOut).
Also a visitor chooses to interact with each animal, so there's a change of
being bited by it. After every interaction a visitor sends his mood status. 
Also all animals have face expressions that are affected by their mood. 
Feeding an animal would make them more happy. All animals have attachable behavior scenarios, 
so it could be easily replaced, as in real life they are not doing the same thing all 
the time. The zoo is initialized using the config file.
  
With this legend we have two way interaction between entities (visitor can feed, 
animal can bite), some kind of a mediator (golf car), replaceable communication
interface (SMS), attachable behaviors, etc.

## Instructions

just run:

* `docker-compose build`
* `docker-compose up`