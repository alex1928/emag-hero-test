<?php

namespace App\Service\Fight;

use App\Entity\Player\Player;
use App\Service\Fight\Commentator\CommentatorInterface;
use App\Service\Fight\PriorityDeterminer\PriorityDeterminerInterface;

/**
 * Class FightFactory
 * @package App\Service\Fight
 */
class FightFactory
{
    /**
     * @var CommentatorInterface
     */
    private $commentator;
    /**
     * @var PriorityDeterminerInterface
     */
    private $priorityDeterminer;


    /**
     * FightFactory constructor.
     * @param CommentatorInterface $commentator
     * @param PriorityDeterminerInterface $priorityDeterminer
     */
    public function __construct(CommentatorInterface $commentator, PriorityDeterminerInterface $priorityDeterminer)
    {
        $this->commentator = $commentator;
        $this->priorityDeterminer = $priorityDeterminer;
    }

    /**
     * @param Player $player1
     * @param Player $player2
     * @return FightInterface
     */
    public function createSparingFight(Player $player1, Player $player2) : FightInterface
    {
        return new SparingFight($player1, $player2, $this->commentator, $this->priorityDeterminer);
    }
}