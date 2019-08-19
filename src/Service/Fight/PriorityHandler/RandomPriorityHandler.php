<?php

namespace App\Service\Fight\PriorityHandler;

use App\Entity\Player\Player;

class RandomPriorityHandler extends PriorityHandler
{
    public function handle(Player $player1, Player $player2): ?int
    {
        return rand(0, 1);
    }
}