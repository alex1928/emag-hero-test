<?php

namespace App\Service\Fight\PriorityDeterminer;

use App\Entity\Player\Player;

interface PriorityDeterminerInterface
{
    public function getFirst(Player $player1, Player $player2): Player;
}