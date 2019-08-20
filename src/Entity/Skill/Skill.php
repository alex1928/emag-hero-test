<?php

namespace App\Entity\Skill;

use App\Service\Fight\Commentator\Commentator;

abstract class Skill implements SkillInterface
{
    protected $name;

    protected $message;

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