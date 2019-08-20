<?php

namespace App\Entity\Skill;


/**
 * Class Skill
 * @package App\Entity\Skill
 */
abstract class Skill implements SkillInterface
{
    /**
     * @var
     */
    protected $name;

    /**
     * @var
     */
    protected $message;

    /**
     * @var
     */
    protected $probability;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getProbability()
    {
        return $this->probability;
    }
}