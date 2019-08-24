<?php
require dirname(__DIR__).'/vendor/autoload.php';

use App\Entity\Player\Player;
use App\Entity\Player\PlayerStats;
use App\Entity\Player\PlayerStatsState;
use App\Entity\Skill\SkillFactory;
use App\Entity\Utils\RandGenerator;
use App\Service\Fight\FightFactory;
use App\Service\Fight\PriorityDeterminer\PriorityDeterminer;
use App\Service\Fight\Commentator\Commentator;
use App\Service\Fight\Commentator\HTMLFightCommentFormatter;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


$randGenerator = new RandGenerator();

$heroStats = new PlayerStats();
$heroStats->setHealth($randGenerator->rand(70, 100));
$heroStats->setStrength($randGenerator->rand(70, 80));
$heroStats->setDefense($randGenerator->rand(45, 55));
$heroStats->setSpeed($randGenerator->rand(40, 50));
$heroStats->setLuck($randGenerator->rand(10, 30));

$heroStartStatsState = new PlayerStatsState($heroStats);


$monsterStats = new PlayerStats();
$monsterStats->setHealth($randGenerator->rand(60, 90));
$monsterStats->setStrength($randGenerator->rand(60, 90));
$monsterStats->setDefense($randGenerator->rand(40, 60));
$monsterStats->setSpeed($randGenerator->rand(40, 60));
$monsterStats->setLuck($randGenerator->rand(25, 40));

$monsterStartStatsState = new PlayerStatsState($monsterStats);


$skillFactory = new SkillFactory();

$playerSkills = [];
$playerSkills[] = $skillFactory->createStrikeTwiceSkill();
$playerSkills[] = $skillFactory->createHalfDamageSkill();


$hero = new Player("Orderus", $heroStats);
$hero->setSkills($playerSkills);

$monster = new Player("Wild Beast", $monsterStats);


$heroBeforeFight = clone $hero;
$monsterBeforeFight = clone $monster;


$fightCommentator = new Commentator();
$priorityDeterminer = new PriorityDeterminer();

$fightFactory = new FightFactory($fightCommentator, $priorityDeterminer);
$sparingFight = $fightFactory->createSparingFight($hero, $monster);

$sparingFight->fight();

$heroStartStatsState->getStats($hero->getStats());
$monsterStartStatsState->getStats($monster->getStats());

$loader = new FilesystemLoader(dirname(__DIR__).'/templates');
$twig = new Environment($loader, [
    'cache' => dirname(__DIR__).'/var/cache/twig_compilation_cache',
]);

echo $twig->render('fight.twig.html', [
    'heroStats' => $hero->getStats(),
    'monsterStats' => $monster->getStats(),
    'fightComments' => $fightCommentator->getComments(),
]);
