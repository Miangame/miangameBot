<?php


namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Model\BotTelegram;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Longman\TelegramBot\Exception\TelegramException;

class BotController extends Controller
{
    public function tryBotAction(Request $request)
    {
        $API_KEY = $this->getParameter('telegram_api_key');

        if ($request->get('code') != $API_KEY) {
            return new JsonResponse("Access Denied");
        }

        $BOT_NAME = $this->getParameter('telegram_bot_name');
        try {
            // Create Telegram API object
            $dir_bots = $this->getParameter('kernel.root_dir') . '/../src/AppBundle/BotCommands';
            $telegram = new BotTelegram($API_KEY, $BOT_NAME, $dir_bots, $this->container);
        } catch (TelegramException $e) {

        }

        $chatId = $request->get('chatId');
        $text = $request->get('text');

        if (true) {
            $customInput = array(
                'update_id' => 87842865,
                'message' => array(
                    "message_id" => 100,
                    'from' => array(
                        'id' => $chatId,
                        'first_name' => 'Swallows',
                        'last_name' => 'Swallows',
                        'username' => '@swallows'
                    ),
                    'chat' => array(
                        'id' => $chatId,
                        'first_name' => 'Swallows',
                        'last_name' => 'Swallows',
                        'username' => '@swallows',
                        'type' => 'private'
                    ),
                    'date' => 1476179342,
                    'text' => $text
                )
            );

            $telegram->setCustomInput(json_encode($customInput));

            // Handle telegram webhook request
            $result = $telegram->handle();

            return new JsonResponse($result);
        }
        return new JsonResponse("Access Denied");
    }
}