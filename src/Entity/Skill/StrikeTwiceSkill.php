<?php

namespace App\Entity\Skill;

class StrikeTwiceSkill extends Skill
{

    public function __construct()
    {
        $this->name = "Rapid Strike";
        $this->message = "{player} used {$this->name} and will hit enemy two times!";
        $this->propability = 10; //10% chance
    }

    public function onAttack()
    {
        // TODO: Implement onAttack() method.
    }

    public function onDefense()
    {
        // TODO: Implement onDefense() method.
    }

}