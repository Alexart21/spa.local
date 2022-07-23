<?php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=127.0.0.1;dbname=alexart1_mih',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    'on afterOpen' => function($event) {
        $event->sender->createCommand("SET GLOBAL time_zone='+03:00';")->execute();
    },
];