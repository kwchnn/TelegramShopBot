<?php
namespace App\Controller;

use App\BotFunction\AdapterBotFunction;
use App\Logger\LoggerClass;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\HtmlFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private $command;
    private $loggerClass;

    public function __construct(AdapterBotFunction $command, LoggerClass $loggerClass)
    {
        $this->command = $command;
        $this->loggerClass = $loggerClass;
    }

    /**
     * @Route("/index", name="index")
     */
    public function actionIndex(Request $request): Response
    {
        try {
            $this->command->requestHandler();
            return new Response(
                "Good",
                Response::HTTP_OK,
                ['content-type' => 'application/json']
            );
        } catch (\Throwable $exception) {
            $this->loggerClass->criticalLogHandler($exception->getMessage());
        }
    }
}