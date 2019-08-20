<?php

namespace App\Service\Fight;

use App\Entity\Player\Player;
use App\Service\Fight\Commentator\Commentator;

interface FightInterface
{
    public function __construct(Player $player1, Player $player2, Commentator $commentator);
    public function fight(): ?Player;
    public function getWinner(): ?Player;
}