<?php

namespace App\Service\Fight;

use App\Entity\Player\Player;
use App\Service\Fight\Commentator\CommentatorInterface;

interface FightInterface
{
    public function __construct(Player $player1, Player $player2, CommentatorInterface $commentator);
    public function fight(): ?Player;
    public function getWinner(): ?Player;
}