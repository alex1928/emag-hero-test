<?php

namespace App\Service\Fight;

use App\Entity\Player\Player;
use App\Service\Fight\Commentator\Commentator;

/**
 * Class FightFactory
 * @package App\Service\Fight
 */
class FightFactory
{
    /**
     * @param Player $player1
     * @param Player $player2
     * @param Commentator $commentator
     * @return FightInterface
     */
    public function createSparingFight(Player $player1, Player $player2, Commentator $commentator) : FightInterface
    {
        return new SparingFight($player1, $player2, $commentator);
    }
}