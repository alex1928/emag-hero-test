<?php

namespace App\Entity\Skill;

use App\Service\Fight\Commentator\Commentator;
use App\Service\Fight\Commentator\FightComment;
use App\Service\Fight\FightPlayer;

class HalfDamageSkill extends Skill
{

    public function __construct()
    {
        $this->name = "Magic shield";
        $this->message = "{name} used {$this->name} and will take only half of damage!";
        $this->probability = 10; //10% chance
    }

    public function onAttack(FightPlayer $attacker, FightPlayer $defender, Commentator $commentator)
    {
        // does nothing
    }

    public function onDefense(FightPlayer $attacker, FightPlayer $defender, Commentator $commentator, $dmg = 0) : int
    {
        $comment = new FightComment($this->message);
        $comment->setPlayerName($attacker->getPlayer()->getName());
        $commentator->addCommentObject($comment);
        return round( $dmg / 2);
    }

}