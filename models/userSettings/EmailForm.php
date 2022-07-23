<?php

namespace app\models\userSettings;

use Yii;
use yii\base\Model;

class EmailForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такой email уже используется.Введите другой'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Введите новый Email',
        ];
    }

    public static function isValidToken($token)
    {
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.registerTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function sendEmail($user)
    {
        if (!$user) {
            return false;
        }

        return Yii::$app->mailer->compose(
            ['html' => 'emailUpdate-html'],
            [
                'user' => $user,
            ]
        )->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
            ->setTo($user->email)
            ->setSubject('Перейдите по ссылке для подтверждения email ' . Yii::$app->name)
            ->send();
    }
}
