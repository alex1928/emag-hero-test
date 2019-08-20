<?php

namespace App\Service\Fight\PriorityHandler;

use App\Entity\Player\Player;

/**
 * Class RandomPriorityHandler
 * @package App\Service\Fight\PriorityHandler
 */
class RandomPriorityHandler extends PriorityHandler
{
    /**
     * @param Player $player1
     * @param Player $player2
     * @return int|null
     */
    public function handle(Player $player1, Player $player2): ?int
    {
        return rand(0, 1);
    }
}