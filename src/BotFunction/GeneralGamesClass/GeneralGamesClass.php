<?php 

namespace App\BotFunction\GeneralGamesClass;

use Doctrine\Persistence\ManagerRegistry;

class GeneralGamesClass
{
    protected $doctrine;
    private $gamesArray = [
        \App\Entity\BlizzardGames::class,
        \App\Entity\OriginGames::class,
        \App\Entity\UbisoftGames::class,
        \App\Entity\SteamGames::class
    ];

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    
    public function getAccounts($gameId) //ищет игру по id и возвращает объект, и все что с ним связано
    {
        $getGamesAccount = $this->doctrine->getManager();

        foreach($this->gamesArray as $arrayItem)
        {
            if($getGamesAccount->getRepository($arrayItem)->findOneBy(['gameId' => $gameId]))
            {
                return $getGamesAccount->getRepository($arrayItem)->findOneBy(['gameId' => $gameId]);
            }
        }
    }
}