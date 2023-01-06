<?php


namespace App\BotFunction\SendAccounts;

use App\BotFunction\GeneralGamesClass\GeneralGamesClass;

class SendAccounts extends GeneralGamesClass
{

    /**
     * Send random game account
     */
    public function getRandomAccount($tgUserId)
    {
        $getProfileManager = $this->doctrine->getManager();
        $profile = $getProfileManager->getRepository(\App\Entity\UserProfile::class)->findOneBy(['tgUserId' => $tgUserId]);
        return $this->getAccountsArray($profile->getLastGameId());
    }

    /**
     * Логика выбора рандомного аккаунта игры
     * @param mixed $gameId
     * @return mixed
     */
    private function getAccountsArray($gameId)
    {
        $getAccountManager = $this->doctrine->getManager();
        $accountArray = $this->getAccounts($gameId);
        if ($accountArray->getBlizzard())
        {
            $arrayItemId = [];
            foreach ($accountArray->getBlizzard() as $arrayItem)
            {
                $arrayItemId[] = $arrayItem->getId();
            }
            $randomId = array_rand($arrayItemId);
            return $getAccountManager->getRepository(\App\Entity\Blizzard::class)->findOneBy(['id' => $arrayItemId[$randomId]]);

        } elseif ($accountArray->getOrigin()) 
        {
            $arrayItemId = [];
            foreach ($accountArray->getOrigin() as $arrayItem)
            {
                $arrayItemId[] = $arrayItem->getId();
            }
            $randomId = array_rand($arrayItemId);
            return $getAccountManager->getRepository(\App\Entity\Origin::class)->findOneBy(['id' => $arrayItemId[$randomId]]);

        } elseif ($accountArray->getSteam()) 
        {
            $arrayItemId = [];
            foreach ($accountArray->getSteam() as $arrayItem)
            {
                $arrayItemId[] = $arrayItem->getId();
            }
            $randomId = array_rand($arrayItemId);
            return $getAccountManager->getRepository(\App\Entity\Steam::class)->findOneBy(['id' => $arrayItemId[$randomId]]);
            
        } elseif ($accountArray->getUbisoft())
        {
            $arrayItemId = [];
            foreach ($accountArray->getUbisfot() as $arrayItem)
            {
                $arrayItemId[] = $arrayItem->getId();
            }
            $randomId = array_rand($arrayItemId);
            return $getAccountManager->getRepository(\App\Entity\Ubisoft::class)->findOneBy(['id' => $arrayItemId[$randomId]]);
        }
    }
}
