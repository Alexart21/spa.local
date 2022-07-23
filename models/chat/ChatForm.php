<?php


namespace app\models\chat;

use Yii;
use yii\base\Model;


class ChatForm extends Model
{
    public $name;
    public $text;

    public function rules()
    {
        return [
            [['name', 'text'], 'required', 'message' => 'это обязательное поле'],
            ['name', 'string', 'max' => 30],
            ['text', 'string', 'max' => 1024],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '',
            'text' => '',
        ];
    }
}