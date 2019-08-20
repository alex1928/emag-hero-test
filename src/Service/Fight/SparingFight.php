<?php

namespace App\Service\Fight;

use App\Service\Fight\Commentator\Commentator;
use App\Service\Fight\PriorityHandler\LuckPriorityHandler;
use App\Service\Fight\PriorityHandler\RandomPriorityHandler;
use App\Service\Fight\PriorityHandler\SpeedPriorityHandler;
use App\Entity\Player\Player;

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
     * @var Commentator
     */
    private $commentator;

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
     * @param Commentator $commentator
     */
    public function __construct(Player $player1, Player $player2, Commentator $commentator)
    {

        if ($this->shouldAttackFirst($player1, $player2)) {

            $this->attacker = new FightPlayer($player1);
            $this->defender = new FightPlayer($player2);
        } else {

            $this->attacker = new FightPlayer($player2);
            $this->defender = new FightPlayer($player1);
        }

        $this->commentator = $commentator;
    }

    /**
     * @param Player $attacker
     * @param Player $defender
     * @return bool
     */
    private function shouldAttackFirst(Player $attacker, Player $defender): bool
    {
        $speedPriorityHandler = new SpeedPriorityHandler();
        $luckPriorityHandler = new LuckPriorityHandler();
        $randomPriorityHandler = new RandomPriorityHandler();
        $speedPriorityHandler->setNext($luckPriorityHandler)->setNext($randomPriorityHandler);

        $result = $speedPriorityHandler->handle($attacker, $defender);

        return $result;
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

        if ($attackerPlayer->getHealth() == $defenderPlayer->getHealth()) {

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

        return $player1->getHealth() > $player2->getHealth() ? $player1 : $player2;
    }


    /**
     * @return Commentator
     */
    public function getCommentator(): Commentator
    {
        return $this->commentator;
    }
}