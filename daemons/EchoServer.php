<?php
namespace app\daemons;

//use consik\yii2websocket\events\WSClientMessageEvent;
//use consik\yii2websocket\WebSocketServer;
use app\daemons\CommandsServer;

class EchoServer extends ChatServer
{

    public function init()
    {
        parent::init();
    }

}