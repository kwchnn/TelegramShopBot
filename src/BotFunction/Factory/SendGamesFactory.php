<?php


namespace App\BotFunction\Factory;

use App\Logger\LoggerClass;

class SendGamesFactory
{
    private $blizzardGames;
    private $originGames;
    private $ubisoftGames;
    private $steamGames;
    private $loggerClass;

    public function __construct(BlizzardGames $blizzardGames, OriginGames $originGames, UbisoftGames $ubisoftGames,
                                SteamGames $steamGames, LoggerClass $loggerClass)
    {
        $this->blizzardGames = $blizzardGames;
        $this->originGames = $originGames;
        $this->ubisoftGames = $ubisoftGames;
        $this->steamGames = $steamGames;
        $this->loggerClass = $loggerClass;
    }

    public function blizzardGames(): BlizzardGames
    {
        try {
            return $this->blizzardGames;
        }
        catch (\Throwable $exception)
        {
            $this->loggerClass->warningLogHandler($exception->getMessage());
        }
    }

    public function originGames(): OriginGames
    {
        try {
            return $this->originGames;
        }
        catch (\Throwable $exception)
        {
            $this->loggerClass->warningLogHandler($exception->getMessage());
        }
    }

    public function ubisoftGames(): UbisoftGames
    {
        try {
            return $this->ubisoftGames;
        }
        catch (\Throwable $exception)
        {
            $this->loggerClass->warningLogHandler($exception->getMessage());
        }
    }

    public function steamGames(): SteamGames
    {
        try {
            return $this->steamGames;
        }
        catch (\Throwable $exception)
        {
            $this->loggerClass->warningLogHandler($exception->getMessage());
        }
    }

}