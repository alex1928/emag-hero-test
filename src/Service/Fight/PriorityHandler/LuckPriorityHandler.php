<?php

namespace App\Service\Fight\PriorityHandler;

use App\Entity\Player\Player;


/**
 * Class LuckPriorityHandler
 * @package App\Service\Fight\PriorityHandler
 */
class LuckPriorityHandler extends PriorityHandler
{

    /**
     * @param Player $player1
     * @param Player $player2
     * @return int|null
     */
    public function handle(Player $player1, Player $player2): ?int
    {
        if($player1->getLuck() != $player2->getLuck()) {
            return $player1->getLuck() > $player2->getLuck();
        } else {
            return parent::handle($player1, $player2);
        }
    }
}