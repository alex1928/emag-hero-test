<?php

namespace App\Service\Fight;

use App\Entity\Player\Player;
use App\Service\Fight\Commentator\CommentatorInterface;
use App\Service\Fight\PriorityDeterminer\PriorityDeterminerInterface;

interface FightInterface
{
    public function __construct(Player $player1, Player $player2, CommentatorInterface $commentator, PriorityDeterminerInterface $priorityDeterminer);
    public function fight(): ?Player;
    public function getWinner(): ?Player;
}