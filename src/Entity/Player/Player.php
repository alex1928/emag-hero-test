<?php

namespace App\Entity\Player;

use App\Service\StatsProvider\PlayerStatsProviderInterface;

class Player
{
    protected $name;

    protected $health;

    protected $strength;

    protected $defense;

    protected $speed;

    protected $luck;


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

    public function isAlive()
    {
        return $this->getHealth() > 0;
    }

    public function dealDamage(int $damage)
    {
        $health = $this->health - $damage;

        if($health < 0) {
            $health = 0;
        }

        $this->setHealth($health);
    }

    /**
     * @param PlayerStatsProviderInterface $statsProvider
     */
    public function setStats(PlayerStatsProviderInterface $statsProvider)
    {
        $this->health = $statsProvider->getHealth();
        $this->strength = $statsProvider->getStrength();
        $this->defense = $statsProvider->getDefence();
        $this->speed = $statsProvider->getSpeed();
        $this->luck = $statsProvider->getLuck();
    }
}