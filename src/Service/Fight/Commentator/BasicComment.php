<?php

namespace App\Service\Fight\Commentator;

/**
 * Class BasicComment
 * @package App\Service\Fight\Commentator
 */
class BasicComment implements CommentInterface
{
    /**
     * @var string
     */
    protected $text;

    /**
     * FightComment constructor.
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->text;
    }
}