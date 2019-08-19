<?php

namespace App\Service\Fight\PriorityHandler;

use App\Entity\Player\Player;

class LuckPriorityHandler extends PriorityHandler
{
    public function handle(Player $player1, Player $player2): ?int
    {
        if($player1->getLuck() != $player2->getLuck()) {
            return $player1->getLuck() > $player2->getLuck();
        } else {
            return parent::handle($player1, $player2);
        }
    }
}