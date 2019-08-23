<?php

namespace App\Service\Fight;


use App\Entity\Player\Player;
use App\Service\Fight\PriorityDeterminer\PriorityDeterminerInterface;
use App\Service\Fight\Commentator\CommentatorInterface;

/**
 * Class SparingFight
 * @package App\Service\Fight
 */
class SparingFight implements FightInterface
{
    /**
     * @var int
     */
    private $currentRound = 0;
    /**
     * @var int
     */
    private $maxRounds = 20;

    /**
     * @var CommentatorInterface
     */
    private $commentator;

    /**
     * @var PriorityDeterminerInterface
     */
    private $priorityDeterminer;

    /**
     * @var FightPlayer
     */
    private $attacker;
    /**
     * @var FightPlayer
     */
    private $defender;

    /**
     * @var bool
     */
    private $fightFinished = false;

    /**
     * SparingFight constructor.
     * @param Player $player1
     * @param Player $player2
     * @param CommentatorInterface $commentator
     * @param PriorityDeterminerInterface $priorityDeterminer
     */
    public function __construct(Player $player1, Player $player2, CommentatorInterface $commentator, PriorityDeterminerInterface $priorityDeterminer)
    {
        $this->commentator = $commentator;
        $this->priorityDeterminer = $priorityDeterminer;

        $this->preparePlayers($player1, $player2);
    }

    /**
     * @param Player $player1
     * @param Player $player2
     */
    private function preparePlayers(Player $player1, Player $player2): void
    {
        $firstPlayer = $this->priorityDeterminer->getFirst($player1, $player2);

        if ($firstPlayer === $player1) {

            $this->attacker = new FightPlayer($player1);
            $this->defender = new FightPlayer($player2);
        } else {

            $this->attacker = new FightPlayer($player2);
            $this->defender = new FightPlayer($player1);
        }
    }

    /**
     * @return Player|null
     */
    public function fight(): ?Player
    {
        do {

            $this->attacker->attack($this->defender, $this->commentator);

            $this->switchRoles();
            $this->currentRound++;

        } while($this->currentRound <= $this->maxRounds && $this->attacker->isAlive() && $this->defender->isAlive());

        $this->fightFinished = true;

        $attackerPlayer = $this->attacker->getPlayer();
        $defenderPlayer = $this->defender->getPlayer();

        if ($attackerPlayer->getStats()->getHealth() == $defenderPlayer->getStats()->getHealth()) {

            $commentText = "The fight ended in a draw.";
            $this->commentator->addComment($commentText, $attackerPlayer, $defenderPlayer);
            return null;
        }

        $winner = $this->getWinner();

        $commentText = "{name} defeated the opponent!";
        $this->commentator->addComment($commentText, $winner, $winner);
        return $winner;
    }

    private function switchRoles(): void
    {
        $tmp = $this->attacker;
        $this->attacker = $this->defender;
        $this->defender = $tmp;
    }

    /**
     * @return Player|null
     */
    public function getWinner(): ?Player
    {
        if (!$this->fightFinished) {
            return null;
        }

        $player1 = $this->attacker->getPlayer();
        $player2 = $this->defender->getPlayer();

        return $player1->getStats()->getHealth() > $player2->getStats()->getHealth() ? $player1 : $player2;
    }


    /**
     * @return CommentatorInterface
     */
    public function getCommentator(): CommentatorInterface
    {
        return $this->commentator;
    }
}