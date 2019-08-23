<?php

namespace App\Service\Fight\Commentator;

/**
 * Class HTMLFightCommentFormatter
 * @package App\Service\Fight\Commentator
 */
class HTMLFightCommentFormatter implements FightCommentFormatterInterface
{
    /**
     * @param FightComment $comment
     * @return string
     */
    public function format(FightComment $comment): string
    {
        $comment_str = str_replace('{name}', '<strong>'.$comment->getPlayerName().'</strong>', $comment->getText());
        $comment_str = str_replace('{dmg}', '<strong>'.$comment->getDmg().'</strong>', $comment_str);
        $comment_str = str_replace('{health_left}', '<strong>'.$comment->getHealthLeft().'</strong>', $comment_str);

        $html  = "<div>";
        $html .= "<p>{$comment_str}</p>";
        $html .= "</div>";

        return $html;
    }
}