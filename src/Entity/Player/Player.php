<?php

namespace App\Entity\Player;

use App\Service\StatsProvider\PlayerStatsProviderInterface;

/**
 * Class Player
 * @package App\Entity\Player
 */
class Player
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var
     */
    protected $health;

    /**
     * @var
     */
    protected $strength;

    /**
     * @var
     */
    protected $defense;

    /**
     * @var
     */
    protected $speed;

    /**
     * @var
     */
    protected $luck;

    /**
     * @var array
     */
    private $skills = [];


    /**
     * Player constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * @param mixed $health
     */
    public function setHealth(int $health)
    {
        $this->health = $health;
    }

    /**
     * @return mixed
     */
    public function getStrength() : int
    {
        return $this->strength;
    }

    /**
     * @param mixed $strength
     */
    public function setStrength(int $strength)
    {
        $this->strength = $strength;
    }

    /**
     * @return mixed
     */
    public function getDefense() : int
    {
        return $this->defense;
    }

    /**
     * @param mixed $defense
     */
    public function setDefense(int $defense)
    {
        $this->defense = $defense;
    }

    /**
     * @return mixed
     */
    public function getSpeed() : int
    {
        return $this->speed;
    }

    /**
     * @param mixed $speed
     */
    public function setSpeed(int $speed)
    {
        $this->speed = $speed;
    }

    /**
     * @return mixed
     */
    public function getLuck() : int
    {
        return $this->luck;
    }

    /**
     * @param mixed $luck
     */
    public function setLuck(int $luck)
    {
        $this->luck = $luck;
    }

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


    /**
     * @param PlayerStatsProviderInterface $statsProvider
     */
    public function setStats(PlayerStatsProviderInterface $statsProvider)
    {
        $this->health   = $statsProvider->getHealth();
        $this->strength = $statsProvider->getStrength();
        $this->defense  = $statsProvider->getDefence();
        $this->speed    = $statsProvider->getSpeed();
        $this->luck     = $statsProvider->getLuck();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $res  = "Name: {$this->getName()}<br>";
        $res .= "Health: {$this->getHealth()}<br>";
        $res .= "Strength: {$this->getStrength()}<br>";
        $res .= "Defense: {$this->getDefense()}<br>";
        $res .= "Speed: {$this->getSpeed()}<br>";
        $res .= "Luck: {$this->getLuck()}%<br>";

        return $res;
    }
}