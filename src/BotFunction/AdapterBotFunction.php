<?php


namespace App\BotFunction;

use App\BotFunction\UsersDatabase\UsersDatabase;
use App\BotFunction\Factory\SendGamesFactory;
use App\BotFunction\SendAccounts\SendAccounts;
use App\ConfigApi\Config;
use Doctrine\Persistence\ManagerRegistry;
use App\Logger\LoggerClass;
use App\BotFunction\Payment\PaymentFunction;


class AdapterBotFunction
{
    private $token;
    private $bot;
    private $botFunctionDatabase;
    private $doctrine;
    private $loggerClass;
    private $sendAccounts;
    private $sendGamesFactory;
    private $payment;

    public function __construct(Config $token, UsersDatabase $botFunctionDatabase, ManagerRegistry $doctrine,
                                LoggerClass $loggerClass, SendAccounts $sendAccounts, SendGamesFactory $sendGamesFactory, PaymentFunction $payment)
    {
        $this->token = $token->getToken();
        $this->bot = new \TelegramBot\Api\Client($this->token);
        $this->botFunctionDatabase = $botFunctionDatabase;
        $this->doctrine = $doctrine;
        $this->loggerClass = $loggerClass;
        $this->sendGamesFactory = $sendGamesFactory;
        $this->sendAccounts = $sendAccounts;
        $this->payment = $payment;
    }

    public function requestHandler() //функция обработки команд и сообщений от пользователя
    {
        $bot = $this->bot;
        $bot->command('start', function ($message) use ($bot) {

            $telegramUser = $message->getFrom();
            $telegramUserName = $telegramUser->getUsername();

            $messageText = "Пожалуйста, выберите раздел на клавиатуре";
            $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
                array(
                    array ("/Товары", "/Профиль"),
                    array ("/Пополнить_баланс"),
                    array ("/Поддержка", "/Правила")), true, true);
            $bot->sendMessage($message->getChat()->getId(), $messageText, null, false, null, $keyboard);

            $this->botFunctionDatabase->saveHandler($message->getChat()->getId(), $telegramUserName);
        });

        $bot->command('Товары', function ($message) use ($bot) {
            $messageText = "Пожалуйста, выберите категорию: ";
            $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
                [
                    [
                        ['text' => 'Blizzard', 'callback_data' => 'Blizzard'],
                        ['text' => 'Origin', 'callback_data' => 'Origin'],
                        ['text' => 'Ubisoft', 'callback_data' => 'Ubisoft'],
                        ['text' => 'Steam', 'callback_data' => 'Steam'],
                    ],
                    [
                        ['text' => 'Discord Nitro', 'callback_data' => 'DiscordNitro'],
                        ['text' => 'Telegram Premium', 'callback_data' => 'TelegramPremium'],
                    ]

                ]
            );
            $bot->sendMessage($message->getChat()->getId(), $messageText, null, false, null, $keyboard);
        });

        $bot->command('Профиль', function ($message) use ($bot) {

            $readUserProfileHandler = $this->botFunctionDatabase->readHandler($message->getChat()->getId());
            $messageText = "<i>Ваш юзернейм: </i>" . $readUserProfileHandler->getUserName() . "\n\n<i>Ваш айди: </i>" .
                $readUserProfileHandler->getTgUserId() .
                "\n\n<i>Количество покупок: </i>" . $readUserProfileHandler->getBuyCount() .
                "\n\n<b><i>Ваш баланс: </i></b>" . $readUserProfileHandler->getAccountBalance() .
                "\n\nЗдесь будет информация по поводу реферальной системы. А пока она дорабатывается";
            $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
                [
                    [
                        ['text' => 'История покупок', 'callback_data' => 'HistoryBuy']
                    ]
                ]
            );
            $bot->sendMessage($message->getChat()->getId(), $messageText, 'HTML', null, false, null, $keyboard);
        });

        $bot->command('Пополнить_баланс', function ($message) use ($bot) {
            $userName = $this->botFunctionDatabase->readHandler($message->getChat()->getId());
            $this->loggerClass->infoLogHandler('Пользователь ' . $userName->getUserName() . ' нажал на раздел <Пополнить_баланс>');
            $messageText = "Пожалуйста, введите сумму пополнения: ";
            $bot->sendMessage($message->getChat()->getId(), $messageText);
        });

        $bot->command('Поддержка', function ($message) use ($bot) {
            $messageText = "Со всеми вопросами обращаться сюда :)\nhttps://тестоваяссылканателеграмканал.ru";
            $bot->sendMessage($message->getChat()->getId(), $messageText);
        });

        $bot->command('Правила', function ($message) use ($bot) {
            $messageText = "Здесь будут описаны правила по активации аккаунта и покупка товара через лиры";
            $bot->sendMessage($message->getChat()->getId(), $messageText);
        });

        $bot->callbackQuery(function ($callbackQuery) use ($bot) {
            switch ($callbackQuery->getData()) {
                case 'Blizzard':
                    $blizzardDbSelect = $this->sendGamesFactory;
                    if (!$blizzardDbSelect->blizzardGames()->sendGames()) {
                        $this->loggerClass->warningLogHandler("В блоке <callback_data> вызова <Blizzard> не получены данные с класса <sendGamesFactory>");
                    }
                    $messageText =
                        "<i><b>Внимание!</b> \nОтправьте сообщение с номером товара для покупки.\nПри покупке аккаунта вы гарантировано получаете игру + бонусы на аккаунте</i>"
                        . "\n\n" . $blizzardDbSelect->blizzardGames()->sendGames(). "Тестирование покупки аккаунтов";
                    break;
                case 'Origin':
                    $originDbSelect = $this->sendGamesFactory;
                    if (!$originDbSelect->originGames()->sendGames()) {
                        $this->loggerClass->warningLogHandler("В блоке <callback_data> вызова <Origin> не получены данные с класса <sendGamesFactory>");
                    }
                    $messageText =
                        "<i><b>Внимание!</b> \nОтправьте сообщение с номером товара для покупки.\nПри покупке аккаунта вы гарантировано получаете игру + бонусы на аккаунте</i>"
                        . "\n\n" . $originDbSelect->originGames()->sendGames() . "Тестирование покупки аккаунтов";
                    break;
                case 'Ubisoft':
                    $ubisoftDbSelect = $this->sendGamesFactory;
                    if (!$ubisoftDbSelect->ubisoftGames()->sendGames()) {
                        $this->loggerClass->warningLogHandler("В блоке <callback_data> вызова <Ubisoft> не получены данные с класса <sendGamesFactory>");
                    }
                    $messageText =
                        "<i><b>Внимание!</b> \nОтправьте сообщение с номером товара для покупки.\nПри покупке аккаунта вы гарантировано получаете игру + бонусы на аккаунте</i>"
                        . "\n\n" . $ubisoftDbSelect->ubisoftGames()->sendGames() . "Тестирование покупки аккаунтов";
                    break;
                case 'Steam':
                    $steamDbSelect = $this->sendGamesFactory;
                    if (!$steamDbSelect->steamGames()->sendGames()) {
                        $this->loggerClass->warningLogHandler("В блоке <callback_data> вызова <Steam> не получены данные с класса <sendGamesFactory>");
                    }
                    $messageText =
                        "<i><b>Внимание!</b> \nОтправьте сообщение с номером товара для покупки.\nПри покупке аккаунта вы гарантировано получаете игру + бонусы на аккаунте</i>"
                        . "\n\n" . $steamDbSelect->steamGames()->sendGames() . "Тестирование покупки аккаунтов";
                    break;

                case 'DiscordNitro':
                    $messageText = "<i><b>Внимание!</b> \nДля приобретения Discord Nitro отправьте сообщение с названием товара сюда-> https://tg.test.link</i>\n\nDiscord Nitro Classic | Месяц | цена\nDiscord Nitro Full | Месяц | цена\nDiscord Nitro Classic | Год | цена\nDiscord Nitro Full | Год | цена";
                    break;

                case 'TelegramPremium':
                    $messageText = "<i><b>Внимание!</b> \nДля приобретения Telegram Premium отправьте сообщение с названием товара сюда-> https://tg.test.link</i>\n\nTelegram Premium | Месяц | цена\nTelegram Premium | 3 Месяца |цена\nTelegram Premium | 6 месяцев |\nTelegram Premium | 1 год | цена";
                    break;

                case 'SendAccounts':
                    $paymentHandler = $this->payment;
                    $sendRandomAccount = $this->sendAccounts;
                    $saveBuyCount = $this->botFunctionDatabase;
                    if ($paymentHandler->paymentMaking($callbackQuery->getMessage()->getChat()->getId())) {
                        $randomAccount = $sendRandomAccount->getRandomAccount($callbackQuery->getMessage()->getChat()->getId());
                        $saveBuyCount->saveBuyHistory($callbackQuery->getMessage()->getChat()->getId());
                        $messageText = "Данные от Вашего аккаунта: " . $randomAccount->getAccountName() . "\nИнформация об активации аккаунта в разделе \"Правила\"\nПриятного использования";
                    } else {
                        $messageText = "Пополните баланс!";
                    }
                    break;
            }
            $bot->sendMessage($callbackQuery->getMessage()->getChat()->getId(), $messageText, 'HTML');
        });

            $bot->on(function ($Update) use ($bot) {
                $message = $Update->getMessage();
                $messageText = $message->getText();
                $sendAccount = $this->sendAccounts;
                $account = $sendAccount->getAccounts($messageText);
                if (!$account) {
                    $bot->sendMessage($message->getChat()->getId(), "Извините, такого Id не найдено");
                } else {
                $this->botFunctionDatabase->saveLastGameId($message->getChat()->getId(), $messageText);
                $sendMessage = "Вы хотите приобрести аккаунт:\n". $account->getName() ."\nСумма: ". $account->getGamePrice(). "\nВсе верно?";
                $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
                    [
                        [
                            ['text' => 'Продолжить', 'callback_data' => 'SendAccounts'],
                            ['text' => 'Вернуться назад', 'callback_data' => 'GoBack']
                        ]
                    ]
                );
                    $bot->sendMessage($message->getChat()->getId(), $sendMessage, null, false, null, $keyboard);
                }
            }, function () { return true; });

        $bot->run();


    }

}