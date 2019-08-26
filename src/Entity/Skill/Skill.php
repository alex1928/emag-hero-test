<?php

namespace App\Entity\Skill;

/**
 * Class Skill
 * @package App\Entity\Skill
 */
abstract class Skill implements SkillInterface
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $message;
    /**
     * @var int
     */
    protected $probability;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getProbability(): int
    {
        return $this->probability;
    }
}