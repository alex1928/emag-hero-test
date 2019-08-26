<?php

namespace App\Service\Fight;

use App\Entity\Utils\RandGeneratorInterface;
use App\Service\Fight\Commentator\CommentatorInterface;
use App\Service\Fight\PriorityDeterminer\PriorityDeterminerInterface;

/**
 * Class FightFactory
 * @package App\Service\Fight
 */
class FightFactory
{
    /**
     * @param CommentatorInterface $commentator
     * @param PriorityDeterminerInterface $priorityDeterminer
     * @param RandGeneratorInterface $randGenerator
     * @return FightInterface
     */
    public function createSparingFight(CommentatorInterface $commentator, PriorityDeterminerInterface $priorityDeterminer, RandGeneratorInterface $randGenerator) : FightInterface
    {
        return new SparingFight($commentator, $priorityDeterminer, $randGenerator);
    }
}