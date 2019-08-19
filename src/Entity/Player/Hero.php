<?php

namespace App\Entity\Player;

class Hero extends Player
{

    private $skills = [];


    /**
     * @return array
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param array $skills
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;
    }
}
