<?php

namespace App\Entity\Skill;

use App\Service\Fight\Commentator\AugmentedComment;
use App\Service\Fight\Commentator\CommentatorInterface;
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
        $this->probability = 20; //20% chance
    }

    /**
     * @param FightPlayer $attacker
     * @param FightPlayer $defender
     * @param CommentatorInterface $commentator
     */
    public function onAttack(FightPlayer $attacker, FightPlayer $defender, CommentatorInterface $commentator): void
    {
        // does nothing
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
        $comment = new AugmentedComment($this->message, [
            'name' => $attacker->getPlayer()->getName(),
        ]);
        $commentator->addComment($comment);

        return (int)round( $damage / 2);
    }
}