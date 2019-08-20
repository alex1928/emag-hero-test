<?php

namespace App\Service\Fight\Commentator;

/**
 * Class FightComment
 * @package App\Service\Fight\Commentator
 */
class FightComment
{
    private $playerName;

    /**
     * @var string
     */
    private $text;
    /**
     * @var int
     */
    private $dmg;
    /**
     * @var int
     */
    private $healthLeft;

    /**
     * FightComment constructor.
     * @param string $content
     * @param int $dmg
     * @param int $healthLeft
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getPlayerName()
    {
        return $this->playerName;
    }

    /**
     * @param mixed $playerName
     */
    public function setPlayerName($playerName)
    {
        $this->playerName = $playerName;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getDmg()
    {
        return $this->dmg;
    }

    /**
     * @param int $dmg
     */
    public function setDmg($dmg)
    {
        $this->dmg = $dmg;
    }

    /**
     * @return int
     */
    public function getHealthLeft()
    {
        return $this->healthLeft;
    }

    /**
     * @param int $healthLeft
     */
    public function setHealthLeft($healthLeft)
    {
        $this->healthLeft = $healthLeft;
    }



    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->text;
    }

}