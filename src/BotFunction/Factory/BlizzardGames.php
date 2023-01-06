<?php


namespace App\BotFunction\Factory;


use App\Entity\UserProfile;
use Doctrine\Persistence\ManagerRegistry;
use App\BotFunction\Factory\GamesInterface;

class BlizzardGames implements GamesInterface
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function sendGames(): string
    {
        $sendGamesHandler = $this->doctrine->getManager();

        $sendGames = $sendGamesHandler->getRepository(\App\Entity\BlizzardGames::class)->findAll();
        $games = [];
        foreach ($sendGames as $blizzardGames) {
            $games[] = "----------------------------------\n";
            $games[] = $blizzardGames->getName();
            $games[] = "\nЦена: ";
            $games[] = $blizzardGames->getGamePrice();
            $games[] = "\nНомер товара: ";
            $games[] = $blizzardGames->getGameId();
            $games[] = "\n";
            $games[] = "----------------------------------\n";
        }
        $stringGames = implode("", $games);

        return $stringGames;
    }
}