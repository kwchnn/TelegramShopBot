<?php

namespace App\BotFunction\Payment;

use App\BotFunction\Payment\PaymentInterface;
use App\BotFunction\GeneralGamesClass\GeneralGamesClass;

class PaymentFunction extends GeneralGamesClass implements PaymentInterface
{
    private $userDoctrineManager;
    private $getUserInfo; //объект с пользователем из бд

    /**
     * Покупка аккаунта
     * @param mixed $tgUserId
     * @return void
     */
    public function paymentMaking($tgUserId)
    {
        $this->userDoctrineManager = $this->doctrine->getManager();

        $this->getUserInfo = $this->userDoctrineManager->getRepository(\App\Entity\UserProfile::class)->findOneBy(['tgUserId' => $tgUserId]);
        return $this->paymentHandler($this->getUserInfo->getLastGameId(), $this->getUserInfo->getAccountBalance());
    }

    /**
     * Метод покупки аккаунта
     * @param mixed $id
     * @param mixed $balance
     * @return void
     */
    private function paymentHandler($id, $balance)
    {
        $getGame = $this->getAccounts($id);
        $getGamePrice = $getGame->getGamePrice();
        if ($balance >= $getGamePrice)
        {
            $newAccountBalance = $balance - $getGamePrice;
            $this->getUserInfo->setAccountBalance($newAccountBalance);
            $this->userDoctrineManager->flush();
            return true;
        }
    }
}