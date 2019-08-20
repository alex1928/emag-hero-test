<?php

namespace App\Service\Fight;

use App\Service\Fight\Commentator\Commentator;
use App\Service\Fight\PriorityHandler\LuckPriorityHandler;
use App\Service\Fight\PriorityHandler\RandomPriorityHandler;
use App\Service\Fight\PriorityHandler\SpeedPriorityHandler;
use App\Entity\Player\Player;

class SparingFight implements FightInterface
{
    private $currentRound;
    private $maxRounds = 20;
    private $commentator;

    private $attacker;
    private $defender;

    private $fightFinnished = false;

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

    public function fight() : ?Player
    {
        do {

            $this->attacker->attack($this->defender, $this->commentator);

            $tmp = $this->attacker;
            $this->attacker = $this->defender;
            $this->defender = $tmp;

            $this->currentRound++;

        } while($this->currentRound <= $this->maxRounds && $this->attacker->isAlive() && $this->defender->isAlive());

        $this->fightFinnished = true;

        if($this->attacker->getPlayer()->getHealth() == $this->defender->getPlayer()->getHealth()) {

            $commentText = "The fight ended in a draw.";
            $this->commentator->addComment($commentText, $this->attacker, $this->defender);
            return null;
        } else {

            $winner = $this->getWinner();

            $commentText = "{name} defeated the opponent!";
            $this->commentator->addComment($commentText, $this->attacker->getPlayer(), $this->defender->getPlayer());
            return $winner;
        }
    }

    public function getWinner() : ?Player
    {
        if(!$this->fightFinnished) {
            return null;
        }

        $player1 = $this->attacker->getPlayer();
        $player2 = $this->defender->getPlayer();

        return $player1->getHealth() > $player2->getHealth() ? $player1 : $player2;
    }

    private function shouldAttackFirst(Player $attacker, Player $defender) : bool
    {
        $speedPriorityHandler = new SpeedPriorityHandler();
        $luckPriorityHandler = new LuckPriorityHandler();
        $randomPriorityHandler = new RandomPriorityHandler();
        $speedPriorityHandler->setNext($luckPriorityHandler)->setNext($randomPriorityHandler);

        $result = $speedPriorityHandler->handle($attacker, $defender);

        return $result;
    }

    /**
     * @return Commentator
     */
    public function getCommentator()
    {
        return $this->commentator;
    }
}