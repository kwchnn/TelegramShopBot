<?php


namespace App\BotFunction\Factory;


use Doctrine\Persistence\ManagerRegistry;
use App\BotFunction\Factory\GamesInterface;

class SteamGames implements GamesInterface
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function sendGames(): string
    {
        $sendGamesHandler = $this->doctrine->getManager();

        $sendGames = $sendGamesHandler->getRepository(\App\Entity\SteamGames::class)->findAll();
        $games = [];
        foreach ($sendGames as $steamGames) {
            $games[] = "----------------------------------\n";
            $games[] = $steamGames->getName();
            $games[] = "\nЦена: ";
            $games[] = $steamGames->getGamePrice();
            $games[] = "\nНомер товара: ";
            $games[] = $steamGames->getGameId();
            $games[] = "\n";
            $games[] = "----------------------------------\n";
        }
        $stringGames = implode("", $games);

        return $stringGames;
    }

}