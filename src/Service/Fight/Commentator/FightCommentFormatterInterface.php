<?php

namespace App\Service\Fight\Commentator;

interface FightCommentFormatterInterface
{
    public function format(FightComment $comment) : string;
}