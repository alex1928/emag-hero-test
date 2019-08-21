<?php

namespace App\Service\Fight\Commentator;

use App\Entity\Player\Player;

interface CommentatorInterface
{
    public function __construct(FightCommentFormatterInterface $commentFormatter);
    public function setFormatter(FightCommentFormatterInterface $formatter): void;
    public function addComment(string $text, Player $attacker, Player $defender, $dmg = 0): void;
    public function addCommentObject(FightComment $comment): void;
    public function getPlainComments(): array;
    public function getFormattedComments(): array;
    public function printFormattedComments(): void;
}