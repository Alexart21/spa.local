<?php


namespace app\modules\alexadmx\models;

use yii\base\Model;


class SetPassForm extends Model
{

    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            [['password', 'password_repeat'], 'required'],
            [['password', 'password_repeat'], 'trim'],
            [['password', 'password_repeat'], 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают !" ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'новый пароль',
            'password_repeat' => 'повторите пароль',
        ];
    }

    public function resetPassword($user)
    {

    }

}