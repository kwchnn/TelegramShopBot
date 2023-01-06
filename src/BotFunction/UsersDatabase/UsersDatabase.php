<?php


namespace App\BotFunction\UsersDatabase;

use App\Entity\UserProfile;
use App\Logger\LoggerClass;
use Doctrine\Persistence\ManagerRegistry;

class UsersDatabase
{
    private $doctrine;
    private $loggerClass;

    public function __construct(ManagerRegistry $doctrine, LoggerClass $loggerClass)
    {
        $this->doctrine = $doctrine;
        $this->loggerClass = $loggerClass;
    }

    public function saveHandler($telegramChatId, $telegramUserName) //Запись пользователя в базу данных
    {
        try {
            $userProfile = $this->doctrine->getRepository(UserProfile::class)->findOneBy(['tgUserId' => $telegramChatId]);
            if (!$userProfile) {
                $saveHandlerManager = $this->doctrine->getManager();
                $user = new UserProfile();
                $user->setTgUserId($telegramChatId);
                $user->setUserName($telegramUserName);
                $user->setBuyCount(0);
                $user->setAccountBalance(0);
                $user->setLastGameId(0);
                $saveHandlerManager->persist($user);
                $saveHandlerManager->flush();
            }
        } catch (\Throwable $exception) {
            $this->loggerClass->warningLogHandler($exception->getMessage()); //запись исключения в лог файл
        }
    }

    public function readHandler($telegramChatId) //Вывод данных о пользователе через базу данных
    {
        try {
            $readHandlerManager = $this->doctrine->getManager();
            $user = $readHandlerManager->getRepository(
                UserProfile::class)->findOneBy(['tgUserId' => $telegramChatId]);
            if (!$user)
            {
                throw new \Exception
                (
            "Функция <readHandler> используя базу данных <UserProfile> не нашла запись по Id $telegramChatId"
                ); //выброс исключений
            }
            return $user; //Возвращает данные пользователя в команду "Профиль"
        }
        catch (\Throwable $exception)
        {
            $this->loggerClass->warningLogHandler($exception->getMessage()); //Запись в лог сообщений об исключении
        }
    }

    /**
     * Сохраняет в базу последнюю игру, которую выбрал пользователь
     * @param mixed $telegramChatId
     * @param mixed $lastGameId
     * @return void
     */
    public function saveLastGameId($telegramChatId, $lastGameId)
    {
        try {
            $userProfile = $this->doctrine->getRepository(UserProfile::class)->findOneBy(['tgUserId' => $telegramChatId]);
            if ($userProfile) {
                $saveHandlerManager = $this->doctrine->getManager();
                $userProfile->setLastGameId($lastGameId);
                $saveHandlerManager->flush();
            }
        } catch (\Throwable $exception) {
            $this->loggerClass->warningLogHandler($exception->getMessage()); //запись исключения в лог файл
        }
    }

    /**
     * +1 при покупке аккаунта записывается в базу таблица количество покупок
     * @param mixed $telegramChatId
     * @return void
     */
    public function saveBuyHistory($telegramChatId)
    {
        try {
            $userProfile = $this->doctrine->getRepository(UserProfile::class)->findOneBy(['tgUserId' => $telegramChatId]);
            if ($userProfile) {
                $saveHandlerManager = $this->doctrine->getManager();
                $buyCount = $userProfile->getBuyCount() + 1;
                $userProfile->setBuyCount($buyCount);
                $saveHandlerManager->flush();
            }
        } catch (\Throwable $exception) {
            $this->loggerClass->warningLogHandler($exception->getMessage()); //запись исключения в лог файл
        }
    }

}