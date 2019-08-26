<?php

namespace App\Service\Fight;


use App\Entity\Player\Player;
use App\Entity\Utils\RandGeneratorInterface;
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
     * @var RandGeneratorInterface
     */
    private $randGenerator;

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
     * @param CommentatorInterface $commentator
     * @param PriorityDeterminerInterface $priorityDeterminer
     * @param RandGeneratorInterface $randGenerator
     */
    public function __construct(CommentatorInterface $commentator, PriorityDeterminerInterface $priorityDeterminer, RandGeneratorInterface $randGenerator)
    {
        $this->commentator = $commentator;
        $this->priorityDeterminer = $priorityDeterminer;
        $this->randGenerator = $randGenerator;
    }

    /**
     * @param Player $player1
     * @param Player $player2
     */
    public function setPlayers(Player $player1, Player $player2): void
    {
        $firstPlayer = $this->priorityDeterminer->getFirst($player1, $player2);

        if ($firstPlayer === $player1) {

            $this->attacker = new FightPlayer($player1, $this->commentator, $this->randGenerator);
            $this->defender = new FightPlayer($player2, $this->commentator, $this->randGenerator);
        } else {

            $this->attacker = new FightPlayer($player2, $this->commentator, $this->randGenerator);
            $this->defender = new FightPlayer($player1, $this->commentator, $this->randGenerator);
        }
    }

    /**
     * @return Player|null
     */
    public function fight(): ?Player
    {
        do {

            $this->attacker->attack($this->defender);

            $this->switchRoles();
            $this->currentRound++;

        } while($this->currentRound <= $this->maxRounds && $this->attacker->isAlive() && $this->defender->isAlive());

        $this->fightFinished = true;

        $attackerPlayer = $this->attacker->getPlayer();
        $defenderPlayer = $this->defender->getPlayer();

        if ($attackerPlayer->getStats()->getHealth() == $defenderPlayer->getStats()->getHealth()) {

            $this->commentator->addTextComment("The fight ended in a draw.");
            return null;
        }

        $winner = $this->getWinner();
        $this->commentator->addTextComment("{$winner->getName()} defeated the opponent!");

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