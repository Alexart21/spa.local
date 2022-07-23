<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\BadRequestHttpException;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{

    public $password;
    public $password_repeat;
//    public $reCaptcha;

    /**
     * @var \app\models\User
     */
    private $_user;

    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new BadRequestHttpException('Пустой токен !');
        }

        $this->_user = User::findByPasswordResetToken($token); // Вот она основная проверка

        if (!$this->_user) {
            throw new BadRequestHttpException('Неверный токен !');
        }

        // еще одна перестраховка
        if ($this->_user->email == Yii::$app->params['adminEmail']){
            throw new BadRequestHttpException('Вы не можете изменить пароль администратора таким способом.');
        }

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password', 'password_repeat'], 'required'],
            [['password', 'password_repeat'], 'trim'],
            [['password', 'password_repeat'], 'string', 'length' => [Yii::$app->params['min_pass_length'], 100]],
            ['password', 'match', 'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^\w\s]).*/', 'message' => 'Пароль должен быть не менее ' . Yii::$app->params['min_pass_length'] . ' символов, только латиница, содержать не менее одной заглавной и строчной буквы, хотя бы одну цифру и спецсимвол'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают !" ],
            //reCaptcha v2
            /*[['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::class,
                'secret' => Yii::$app->params['secretV2'], // unnecessary if reСaptcha is already configured
                'uncheckedMessage' => 'Подтвердите, что вы не робот'],*/

            //reCaptcha v3
            /* [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator3::className(),
                 'secret' => Yii::$app->params['secretV3'], // unnecessary if reСaptcha is already configured
                 'threshold' => 0.5,
                 'action' => 'reset-password',
             ],*/
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'новый пароль',
            'password_repeat' => 'повторите пароль',
//            'reCaptcha' => '',
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        $save = $user->save(false);
        return $save ? $user->username : null; // имя пригодиться
    }

}