<?php

namespace App\Service\Fight\PriorityHandler;

use App\Entity\Player\Player;

interface PriorityHandlerInterface
{
    public function setNext(PriorityHandler $handler) : PriorityHandler;
    public function handle(Player $player1, Player $player2) : ?int;
}