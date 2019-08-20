<?php

namespace App\Entity\Skill;

use App\Service\Fight\Commentator\Commentator;
use App\Service\Fight\Commentator\FightComment;
use App\Service\Fight\FightPlayer;


/**
 * Class HalfDamageSkill
 * @package App\Entity\Skill
 */
class HalfDamageSkill extends Skill
{
    /**
     * HalfDamageSkill constructor.
     */
    public function __construct()
    {
        $this->name = "Magic Shield";
        $this->message = "{name} used {$this->name} and will take only half of damage!";
        $this->probability = 10; //10% chance
    }

    /**
     * @param FightPlayer $attacker
     * @param FightPlayer $defender
     * @param Commentator $commentator
     */
    public function onAttack(FightPlayer $attacker, FightPlayer $defender, Commentator $commentator): void
    {
        // does nothing
    }

    /**
     * @param FightPlayer $attacker
     * @param FightPlayer $defender
     * @param Commentator $commentator
     * @param int $dmg
     * @return int
     */
    public function onDefense(FightPlayer $attacker, FightPlayer $defender, Commentator $commentator, $dmg = 0): int
    {
        $comment = new FightComment($this->message);
        $comment->setPlayerName($defender->getPlayer()->getName());
        $commentator->addCommentObject($comment);
        return round( $dmg / 2);
    }
}