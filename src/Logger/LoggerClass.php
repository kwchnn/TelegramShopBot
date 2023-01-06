<?php


namespace App\Logger;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerClass
{
    public function infoLogHandler($message)
    {
        $infoLogHandler = new Logger('user_action');
        $infoLogHandler->pushHandler(new StreamHandler('../var/log/info_'.date("d-M-Y").'.log', Logger::INFO));
        $infoLogHandler->info($message);
    }

    public function criticalLogHandler($message)
    {
        $criticalLogHandler = new Logger('app_kernel_panic!');
        $criticalLogHandler->pushHandler(new StreamHandler('../var/log/critical_'.date("d-M-Y").'.log', Logger::CRITICAL));
        $criticalLogHandler->critical($message);
    }

    public function warningLogHandler($message)
    {
        $criticalLogHandler = new Logger('app_warning');
        $criticalLogHandler->pushHandler(new StreamHandler('../var/log/warning_'.date("d-M-Y").'.log', Logger::WARNING));
        $criticalLogHandler->warning($message);
    }

    public function paymentLogHandler($message)
    {
        $criticalLogHandler = new Logger('app_payment');
        $criticalLogHandler->pushHandler(new StreamHandler('../var/log/payment_'.date("d-M-Y").'.log', Logger::WARNING));
        $criticalLogHandler->warning($message);
    }
}