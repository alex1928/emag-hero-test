<?php

namespace App\Entity\Skill;

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
     * @param int $dmg
     * @return int
     */
    public function onDefense(FightPlayer $attacker, FightPlayer $defender, CommentatorInterface $commentator, $dmg = 0): int
    {
        $comment = new FightComment($this->message);
        $comment->setPlayerName($defender->getPlayer()->getName());
        $commentator->addCommentObject($comment);
        return round( $dmg / 2);
    }
}