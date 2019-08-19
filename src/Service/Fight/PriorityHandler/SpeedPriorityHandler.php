<?php

namespace App\Service\Fight\PriorityHandler;

use App\Entity\Player\Player;

class SpeedPriorityHandler extends PriorityHandler
{
    public function handle(Player $player1, Player $player2): ?int
    {
        if($player1->getSpeed() != $player2->getSpeed()) {
            return $player1->getSpeed() > $player2->getSpeed();
        } else {
            return parent::handle($player1, $player2);
        }
    }
}