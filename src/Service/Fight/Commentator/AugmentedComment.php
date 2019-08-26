<?php

namespace App\Service\Fight\Commentator;

/**
 * Class AugmentedComment
 * @package App\Service\Fight\Commentator
 */
class AugmentedComment extends BasicComment
{
    /**
     * @var
     */
    private $data;

    /**
     * FightComment constructor.
     * @param string $text
     * @param array $data
     */
    public function __construct(string $text, array $data)
    {
        parent::__construct($text);
        $this->setCommentWithData($data);
    }

    /**
     * @param string $text
     * @param array $data
     */
    private function setCommentWithData(array $data): void
    {
        foreach($data as $key => $value) {

            $this->text = $this->replaceKeyWithValue($this->text, $key, $value);
        }
    }

    /**
     * @param string $text
     * @param string $key
     * @param mixed $value
     * @return string
     */
    private function replaceKeyWithValue(string $text, string $key, $value): string
    {
        return str_replace("{".$key."}", $value, $text);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->text;
    }
}