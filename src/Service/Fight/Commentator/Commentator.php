<?php

namespace App\Service\Fight\Commentator;

use App\Entity\Player\Player;

/**
 * Class Commentator
 * @package App\Service\Fight\Commentator
 */
class Commentator implements CommentatorInterface
{
    /**
     * @var array
     */
    private $comments = [];
    /**
     * @var FightCommentFormatterInterface
     */
    private $commentFormatter;

    /**
     * Commentator constructor.
     * @param FightCommentFormatterInterface $commentFormatter
     */
    public function __construct(FightCommentFormatterInterface $commentFormatter)
    {
        $this->commentFormatter = $commentFormatter;
    }

    /**
     * @param string $text
     * @param Player $attacker
     * @param Player $defender
     * @param int $dmg
     */
    public function addComment(string $text, Player $attacker, Player $defender, $dmg = 0): void
    {
        $comment = new FightComment($text);
        $comment->setPlayerName($attacker->getName());
        $comment->setHealthLeft($defender->getStats()->getHealth());
        $comment->setDmg($dmg);

        $this->addCommentObject($comment);
    }

    /**
     * @param FightComment $comment
     */
    public function addCommentObject(FightComment $comment): void
    {
        $this->comments[] = $comment;
    }

    /**
     * @return array
     */
    public function getPlainComments(): array
    {
        return $this->comments;
    }

    /**
     * @return array
     */
    public function getFormattedComments(): array
    {
        $formattedComments = [];

        foreach ($this->comments as $comment) {
            $formattedComments[] = $this->commentFormatter->format($comment);
        }

        return $formattedComments;
    }

    public function printFormattedComments(): void
    {
        $formattedComments = $this->getFormattedComments();

        foreach ($formattedComments as $comment) {
            echo $comment;
        }
    }
}
