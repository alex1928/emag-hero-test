<?php

namespace App\Service\Fight;

use App\Entity\Player\Player;
use App\Service\Fight\Commentator\Commentator;

class FightFactory
{
    public function createSparingFight(Player $player1, Player $player2, Commentator $commentator) : FightInterface
    {
        return new SparingFight($player1, $player2, $commentator);
    }
}