<?php

namespace App\Service\Fight\Commentator;

use App\Entity\Player\Player;

/**
 * Class Commentator
 * @package App\Service\Fight\Commentator
 */
class Commentator
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
     * @param FightCommentFormatterInterface $formatter
     */
    public function setFormatter(FightCommentFormatterInterface $formatter)
    {
        $this->commentFormatter = $formatter;
    }

    /**
     * @param string $text
     * @param int $dmg
     * @param int $healthLeft
     */
    public function addComment(string $text, Player $attacker, Player $defender, $dmg = 0)
    {
        $comment = new FightComment($text);
        $comment->setPlayerName($attacker->getName());
        $comment->setHealthLeft($defender->getHealth());
        $comment->setDmg($dmg);

        $this->addCommentObject($comment);
    }

    /**
     * @param FightComment $comment
     */
    public function addCommentObject(FightComment $comment)
    {
        $this->comments[] = $comment;
    }

    /**
     * @return array
     */
    public function getPlainComments() : array
    {
        return $this->comments;
    }

    /**
     * @return array
     */
    public function getFormattedComments() : array
    {
        $formattedComments = [];

        foreach($this->comments as $comment) {

            $formattedComments[] = $this->commentFormatter->format($comment);
        }

        return $formattedComments;
    }

    /**
     *
     */
    public function printFormattedComments()
    {
        $formattedComments = $this->getFormattedComments();

        foreach($formattedComments as $comment) {
            echo $comment;
        }
    }
}
