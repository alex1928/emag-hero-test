<?php
require __DIR__ . '/vendor/autoload.php';


use App\Entity\Player\Hero;
use App\Entity\Player\Player;
use App\Service\StatsProvider\PlayerStatsRandomizer;
use App\Entity\Utils\Range;
use App\Service\Fight\Fight;


$heroStatProvider = new PlayerStatsRandomizer(
    new Range(70, 100),
    new Range(70, 80),
    new Range(45, 55),
    new Range(40, 50),
    new Range(10, 30)
);

$monsterStatProvider = new PlayerStatsRandomizer(
    new Range(60, 90),
    new Range(60, 90),
    new Range(40, 60),
    new Range(40, 60),
    new Range(25, 40)
);

$hero = new Hero("Orderus");
$hero->setStats($heroStatProvider);

$monster = new Player("Wild Beast");
$monster->setStats($monsterStatProvider);


$fight = new Fight($hero, $monster);
$fight->fight();

$messages = $fight->getMessages();
foreach($messages as $message) {

    echo $message . '<hr>';
}