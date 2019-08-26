<?php

namespace App\Service\Fight\Commentator;

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
     * @param string $text
     */
    public function addTextComment(string $text): void
    {
        $comment = new BasicComment($text);
        $this->addComment($comment);
    }

    /**
     * @param CommentInterface $comment
     */
    public function addComment(CommentInterface $comment): void
    {
        $this->comments[] = $comment;
    }

    /**
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }
}
