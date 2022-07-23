<?php


namespace app\models\userSettings;

use yii\db\ActiveRecord;
use Yii;

class CloseForm extends ActiveRecord
{
    public $password;

    public function rules()
    {
        return [
            ['password', 'trim'],
            ['password', 'required', 'message' => 'Пароль обязателен!'],
            ['password', 'string', 'length' => [Yii::$app->params['min_pass_length'], 100]],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = User::findOne(\Yii::$app->user->identity->getId());
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверный пароль');
            }
        }
    }

    public function attributeLabels()
    {
        return[
            'password' => 'пароль',
        ];
    }
}