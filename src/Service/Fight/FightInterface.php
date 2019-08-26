<?php

namespace App\Service\Fight;

use App\Entity\Player\Player;

interface FightInterface
{
    public function fight(): ?Player;
    public function getWinner(): ?Player;
    public function setPlayers(Player $player1, Player $player2): void;
}