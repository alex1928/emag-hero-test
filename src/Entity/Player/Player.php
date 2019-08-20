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
    private $name;
    /**
     * @var int
     */
    private $health;
    /**
     * @var int
     */
    private $strength;
    /**
     * @var int
     */
    private $defense;
    /**
     * @var int
     */
    private $speed;
    /**
     * @var int
     */
    private $luck;
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @param int $health
     */
    public function setHealth(int $health): void
    {
        $this->health = $health;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @param int $strength
     */
    public function setStrength(int $strength): void
    {
        $this->strength = $strength;
    }

    /**
     * @return int
     */
    public function getDefense(): int
    {
        return $this->defense;
    }

    /**
     * @param int $defense
     */
    public function setDefense(int $defense): void
    {
        $this->defense = $defense;
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @param int $speed
     */
    public function setSpeed(int $speed): void
    {
        $this->speed = $speed;
    }

    /**
     * @return int
     */
    public function getLuck(): int
    {
        return $this->luck;
    }

    /**
     * @param int $luck
     */
    public function setLuck(int $luck): void
    {
        $this->luck = $luck;
    }

    /**
     * @return array
     */
    public function getSkills(): array
    {
        return $this->skills;
    }

    /**
     * @param $skills
     */
    public function setSkills($skills): void
    {
        $this->skills = $skills;
    }

    /**
     * @param PlayerStatsProviderInterface $statsProvider
     */
    public function setStats(PlayerStatsProviderInterface $statsProvider): void
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
    public function __toString(): string
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