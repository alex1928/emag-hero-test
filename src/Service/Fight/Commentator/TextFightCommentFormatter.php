<?php

namespace App\Service\Fight\Commentator;

class TextFightCommentFormatter implements FightCommentFormatterInterface
{
    public function format(FightComment $comment): string
    {
        $comment_str = str_replace('{name}', $comment->getPlayerName(), $comment->getText());
        $comment_str = str_replace('{dmg}', $comment->getDmg(), $comment_str);
        $comment_str = str_replace('{health_left}', $comment->getHealthLeft(), $comment_str);

        return $comment_str . "<br>";
    }
}