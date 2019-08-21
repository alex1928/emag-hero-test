<?php

namespace App\Service\Fight\PriorityDeterminer\PriorityHandler;

use App\Entity\Player\Player;

/**
 * Class SpeedPriorityHandler
 * @package App\Service\Fight\PriorityHandler
 */
class SpeedPriorityHandler extends PriorityHandler
{
    /**
     * @param Player $player1
     * @param Player $player2
     * @return int|null
     */
    public function handle(Player $player1, Player $player2): ?int
    {
        if ($player1->getSpeed() != $player2->getSpeed()) {
            return $player1->getSpeed() > $player2->getSpeed();
        }

        return parent::handle($player1, $player2);
    }
}