<?php

namespace App\BotFunction\Payment;

interface PaymentInterface
{
    public function paymentMaking($tgUserId);

}