<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\helpers\Html;

//var_dump(Yii::$app->params['secretV2']);die;

/**
 * Signup form
 */
class SignupForm extends Model
{

    public $username;
    public $email;
//    public $avatar;
    public $password;
    public $password_repeat;
//    public $reCaptcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'match', 'pattern' => '/^[a-z]\w*$/i', 'message' => 'Имя должно начинаться с буквы и содержать только буквенные символы,числовые символы и знак подчеркивания'],
            [['username', 'email', 'password', 'password_repeat'], 'required', 'message' => 'Это обязательное поле'],
            [['username', 'email', 'password', 'password_repeat'], 'trim'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такое имя уже существует.Введите другое'],
            ['username', 'string', 'length' => [3, 100]],
            ['email', 'email'],
            ['email', 'string', 'max' => 100],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такой email уже существует.Введите другой'],
            ['password', 'string', 'length' => [Yii::$app->params['min_pass_length'], 100]],
            ['password', 'match', 'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^\w\s]).*/', 'message' => 'Пароль должен быть не менее ' . Yii::$app->params['min_pass_length'] . ' символов, только латиница, содержать не менее одной заглавной буквы, хотя бы одну цифру и спецсимвол'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Пароли не совпадают !"],
//            [['avatar'], 'file', 'extensions' => ['jpeg', 'jpg', 'png', 'gif', 'webp'], 'skipOnEmpty' => true, 'maxSize' => 1024 * Yii::$app->params['max_avatar_size']],
            //            //reCaptcha v2
            /*[['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::class,
                'secret' => Yii::$app->params['secretV2'], // unnecessary if reСaptcha is already configured
                'uncheckedMessage' => 'Подтвердите, что вы не робот'],*/

            //reCaptcha v3
            /* [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator3::className(),
                 'secret' => Yii::$app->params['secretV3'], // unnecessary if reСaptcha is already configured
                 'threshold' => 0.5,
                 'action' => 'signup',
             ],*/
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'email' => 'email',
            'password' => 'пароль',
            'password_repeat' => 'повторите пароль',
            'avatar' => 'фото на аватар',
//            'reCaptcha' => '',
        ];
    }

    public function sendEmail($user, $model)
    {
        if (!$user) {
            return false;
        }

        return Yii::$app->mailer->compose(
            ['html' => 'signUp-html'],
            [
                'user' => $user,
                'password' => $model->password,
            ]
        )->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
            ->setTo($user->email)
            ->setSubject('Подтверждение регистрации ' . Yii::$app->name)
            ->send();
    }


    /* Заносим в базу как юзера с неподтвержденной регистрацией и оправляем письмо */
    public function signupRequest()
    {
        $user = new User();

        $transaction = User::getDb()->beginTransaction();
        try {
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = 1;
            $user->register_token = Yii::$app->security->generateRandomString(30) . '_' . time();
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $save = $user->save();
            $result = $save && self::sendEmail($user, $this);
            if ($result) {
                $transaction->commit();
                // Если все Ок то возвращаем ID нового пользователя.
                return $user->id;
            } else {
                $transaction->rollBack();
                return false;
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }

    }

    /* Существует ли */

    public static function isValidToken($token) // Здесь проверяем токен лишь на "срок годности"
    {
        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.registerTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /* Загрузка аватара */
    /*public function uploadAvatar()
    {
        if ($this->validate()) {
            $path = 'upload/avatars/' . $this->avatar->baseName . '.' . $this->avatar->extension;
            $this->avatar->saveAs($path);
            return true;
        } else {
            return false;
        }
    }*/

}
