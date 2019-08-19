<?php

namespace App\Service\Fight;

use App\Entity\Utils\FightMessage;
use App\Service\Fight\PriorityHandler\LuckPriorityHandler;
use App\Service\Fight\PriorityHandler\RandomPriorityHandler;
use App\Service\Fight\PriorityHandler\SpeedPriorityHandler;
use App\Entity\Player\Player;

class Fight
{
    private $currentRound;
    private $maxRounds = 20;
    private $fightMessages = [];

    private $player1;
    private $player2;

    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    public function fight()
    {
        $attacker = null;
        $defender = null;

        if ($this->shouldAttackFirst($this->player1, $this->player2)) {
            $attacker = $this->player1;
            $defender = $this->player2;
        } else {
            $attacker = $this->player2;
            $defender = $this->player1;
        }

        do {

            $this->makeTurn($attacker, $defender);

            $tmp = $attacker;
            $attacker = $defender;
            $defender = $tmp;

        } while($this->currentRound < $this->maxRounds && $attacker->isAlive() && $defender->isAlive());
    }


    private function makeTurn(Player $attacker, Player $defender)
    {

        $dmg = $this->getDmg($attacker, $defender);
        $defender->dealDamage($dmg);

        $message = new FightMessage("{$attacker->getName()} hit {$defender->getName()} dealing {$dmg} damage.");

        $this->fightMessages[] = $message;
    }

    private function getDmg(Player $attacker, Player $defender)
    {
        $dmg = $attacker->getStrength() - $defender->getDefense();

        if($dmg < 0)
            $dmg = 0;

        return $dmg;
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


    public function getMessages()
    {
        return $this->fightMessages;
    }
}