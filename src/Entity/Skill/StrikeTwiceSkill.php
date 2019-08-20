<?php

namespace App\Entity\Skill;

use App\Service\Fight\Commentator\Commentator;
use App\Service\Fight\FightPlayer;

class StrikeTwiceSkill extends Skill
{
    public function __construct()
    {
        $this->name = "Rapid Strike";
        $this->message = "{name} used {$this->name} and will hit enemy two times!";
        $this->probability = 10; //10% chance
    }

    public function onAttack(FightPlayer $attacker, FightPlayer $defender, Commentator $commentator)
    {
        $commentator->addComment($this->message, $attacker->getPlayer(), $defender->getPlayer());
        $attacker->hit($defender, $commentator);
    }

    public function onDefense(FightPlayer $attacker, FightPlayer $defender, Commentator $commentator, $dmg = 0) : int
    {
        return $dmg;
    }

}