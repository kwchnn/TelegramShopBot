<?php


namespace App\BotFunction\Factory;


use Doctrine\Persistence\ManagerRegistry;
use App\BotFunction\Factory\GamesInterface;

class OriginGames implements GamesInterface
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function sendGames(): string
    {
        $sendGamesHandler = $this->doctrine->getManager();

        $sendGames = $sendGamesHandler->getRepository(\App\Entity\OriginGames::class)->findAll();
        $games = [];
        foreach ($sendGames as $originGames) {
            $games[] = "----------------------------------\n";
            $games[] = $originGames->getName();
            $games[] = "\nЦена: ";
            $games[] = $originGames->getGamePrice();
            $games[] = "\nНомер товара: ";
            $games[] = $originGames->getGameId();
            $games[] = "\n";
            $games[] = "----------------------------------\n";
        }
        $stringGames = implode("", $games);

        return $stringGames;
    }

}