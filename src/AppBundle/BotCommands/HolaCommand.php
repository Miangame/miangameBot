<?php

namespace AppBundle\BotCommands;


use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\Message;
use Longman\TelegramBot\Request;

class HolaCommand extends UserCommand
{

    protected $name = 'hola';
    protected $description = 'Di hola, respondo adios';
    protected $usage = '/hola';
    protected $version = '1.0.0';

    public function execute()
    {
        /** @var Message $message */
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();

        $data = [];
        $data['chat_id'] = $chat_id;
        $data['text'] = "Hola! ¿Cómo estás?";

        return Request::sendMessage($data);
    }
}