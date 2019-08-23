<?php

namespace App\Service\Fight\Commentator;

use App\Entity\Player\Player;

interface CommentatorInterface
{
    public function addComment(string $text, Player $attacker, Player $defender, $damage = 0): void;
    public function addCommentObject(FightComment $comment): void;
    public function getComments(): array;
}