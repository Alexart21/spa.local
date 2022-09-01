<?php

namespace app\models;

//use app\models\User;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $login_or_email;
    public $password;
    public $rememberMe = false;
    public $reCaptcha;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['login_or_email', 'password'], 'required', 'message' => 'заполните это поле !'],
            [['login_or_email', 'password'], 'trim'],
            ['login_or_email',  'string', 'length' => [3, 100]],
            ['login_or_email',  'validateLoginOrEmail'],
            ['password', 'string', 'length' => [Yii::$app->params['min_pass_length'], 100]],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
            //reCaptcha v2
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::class,
                'secret' => Yii::$app->params['secretV2'], // unnecessary if reСaptcha is already configured
                'uncheckedMessage' => 'Подтвердите, что вы не робот'],

            //reCaptcha v3
            /*[['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator3::class,
                'secret' => Yii::$app->params['secretV3'], // unnecessary if reСaptcha is already configured
                'threshold' => 0.5,
                'action' => 'login',
            ],*/
        ];
    }

    public function attributeLabels()
    {
        return [
//            'email' => 'Ваш E-mail',
            'login_or_email' => 'Ваше имя или E-mail',
            'password' => 'Пароль',
            'rememberMe' => '',
            'reCaptcha' => '',
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
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверные логин/пароль');
            }
        }
    }

    public function validateLoginOrEmail($attribute, $params)
    {
        if (!User::findByUsernameOrEmail($this->$attribute)){
            $this->addError($attribute, 'Нет такого пользователя!');
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    //         15552000 - 180 суток
    public function login()
    {
        if ($this->validate()) {
            if ($this->rememberMe) {
                $u = $this->getUser();
                $u->generateAuthKey();
                $u->save();
            }
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? Yii::$app->params['rememberMeSec'] : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsernameOrEmail($this->login_or_email);
        }

        return $this->_user;
    }

    /*public function loginAdmin()
    {
        if ($this->validate() && User::isUserAdmin($this->username)) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? Yii::$app->params['rememberMeSec'] : 0);
        } else {
            return false;
        }
    }*/
}
