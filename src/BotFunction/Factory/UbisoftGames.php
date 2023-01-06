<?php


namespace App\BotFunction\Factory;

use Doctrine\Persistence\ManagerRegistry;
use App\BotFunction\Factory\GamesInterface;

class UbisoftGames implements GamesInterface
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function sendGames(): string
    {
        $sendGamesHandler = $this->doctrine->getManager();

        $sendGames = $sendGamesHandler->getRepository(\App\Entity\UbisoftGames::class)->findAll();
        $games = [];
        foreach ($sendGames as $ubisoftGames) {
            $games[] = "----------------------------------\n";
            $games[] = $ubisoftGames->getName();
            $games[] = "\nЦена: ";
            $games[] = $ubisoftGames->getGamePrice();
            $games[] = "\nНомер товара: ";
            $games[] = $ubisoftGames->getGameId();
            $games[] = "\n";
            $games[] = "----------------------------------\n";
        }
        $stringGames = implode("", $games);

        return $stringGames;
    }

}