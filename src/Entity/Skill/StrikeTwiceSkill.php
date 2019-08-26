<?php

namespace App\Entity\Skill;

use App\Service\Fight\Commentator\AugmentedComment;
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
        $attackComment = new AugmentedComment($this->message, [
           'name' => $attacker->getPlayer()->getName(),
        ]);
        $commentator->addComment($attackComment);

        $attacker->hit($defender);
    }

    /**
     * @param FightPlayer $attacker
     * @param FightPlayer $defender
     * @param CommentatorInterface $commentator
     * @param int $damage
     * @return int
     */
    public function onDefense(FightPlayer $attacker, FightPlayer $defender, CommentatorInterface $commentator, $damage = 0): int
    {
        return $damage;
    }
}