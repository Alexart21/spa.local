<?php
namespace app\daemons;

use consik\yii2websocket\events\WSClientEvent;
use consik\yii2websocket\WebSocketServer;
use Ratchet\ConnectionInterface;
use yii\db\ActiveRecord;
use Yii;
use yii\helpers\StringHelper;
use app\models\chat\WSchat;

class ChatServer extends WebSocketServer
{
    const MAX_NAME_LENGTH = 30; // должно соответствовать атрибуту maxlenght  в теге input
    const MAX_MSG_LENGHT = 1000; // должно соответствовать атрибуту maxlenght  в теге input

    public function init()
    {
        parent::init();

        $this->on(self::EVENT_CLIENT_CONNECTED, function(WSClientEvent $e) {
            $e->client->name = null;
        });
    }


    protected function getCommand(ConnectionInterface $from, $msg)
    {
        $request = json_decode($msg, true);
        return !empty($request['action']) ? $request['action'] : parent::getCommand($from, $msg);
    }

    public function commandChat(ConnectionInterface $client, $msg)
    {
        $request = json_decode($msg, true);
        $result = ['message' => ''];

        if (!$client->name) {
            $result['message'] = 'Введите имя и нажмите "установить"';
        } elseif (!empty($request['message']) && $message = trim($request['message']) ) {

            foreach ($this->clients as $chatClient) {
                $message = StringHelper::truncate($message, self::MAX_MSG_LENGHT);
                $chatClient->send( json_encode([
                    'type' => 'chat',
                    'from' => $client->name,
                    'message' => $message,
                    'user_color' => $request['user_color'],
                ]) );
                /* Пишем в БД */
                $newMsg = new WSchat();
                $newMsg->name = $client->name;
                // $newMsg->ip = $_SERVER['REMOTE_ADDR'];
                $newMsg->text = $message;
                $newMsg->color = $request['user_color'];
                $newMsg->save();
            }

        } else {
            $result['message'] = 'Введите сообщение';
        }

        $client->send( json_encode($result) );
    }

    public function commandSetName(ConnectionInterface $client, $msg)
    {
        $request = json_decode($msg, true);
        $result = ['message' => 'Имя установлено'];

        if (!empty($request['name']) && $name = trim($request['name'])) {
            $usernameFree = true;
            foreach ($this->clients as $chatClient) {
                if ($chatClient != $client && $chatClient->name == $name) {
                    $result['message'] = 'Это имя уже используется. Придумайте другое.';
                    $usernameFree = false;
                    break;
                }
            }

            if ($usernameFree) {
                $name = StringHelper::truncate($name, self::MAX_NAME_LENGTH);
                $client->name = $name;

                $color = self::rndColor();

                $result['user_color'] = $color;
                $result['user_name'] = $name;
                $result['type'] = 'set';
            }
        } else {
            $result['message'] = 'Некорректное имя';
        }

        $client->send( json_encode($result) );
    }

    public static function getMessages()
    {
        return ActiveRecord::find()->orderBy('id DESC')->limit(self::MSG_LIMIT)->all();
    }

    public static function rndColor()
    {
        // return '#' . dechex(rand(0,10000000));;
        return (string)rand(0, 359);
    }

}