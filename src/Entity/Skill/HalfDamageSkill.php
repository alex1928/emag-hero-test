<?php

namespace App\Entity\Skill;

class HalfDamageSkill extends Skill
{

    public function __construct()
    {
        $this->name = "Magic shield";
        $this->message = "{player} used {$this->name} and will take only half of damage!";
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