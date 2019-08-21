<?php

namespace App\Entity\Skill;

use App\Service\Fight\Commentator\CommentatorInterface;
use App\Service\Fight\FightPlayer;


/**
 * Class StrikeTwiceSkill
 * @package App\Entity\Skill
 */
class StrikeTwiceSkill extends Skill
{
    /**
     * StrikeTwiceSkill constructor.
     */
    public function __construct()
    {
        $this->name = "Rapid Strike";
        $this->message = "{name} used {$this->name} and will hit enemy two times!";
        $this->probability = 10; //10% chance
    }

    /**
     * @param FightPlayer $attacker
     * @param FightPlayer $defender
     * @param CommentatorInterface $commentator
     */
    public function onAttack(FightPlayer $attacker, FightPlayer $defender, CommentatorInterface $commentator): void
    {
        $commentator->addComment($this->message, $attacker->getPlayer(), $defender->getPlayer());
        $attacker->hit($defender, $commentator);
    }

    /**
     * @param FightPlayer $attacker
     * @param FightPlayer $defender
     * @param CommentatorInterface $commentator
     * @param int $dmg
     * @return int
     */
    public function onDefense(FightPlayer $attacker, FightPlayer $defender, CommentatorInterface $commentator, $dmg = 0): int
    {
        return $dmg;
    }
}