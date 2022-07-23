<?php

namespace app\models\userSettings;

use app\models\Auth;
use Yii;

//var_dump(Yii::$app->user->identity->getId());

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $username
 * @property string $old_username
 * @property string $email
 * @property string $old_email
 * @property string $avatar_path
 * @property int $role
 * @property string $password_hash
 * @property string $auth_key
 * @property string $register_token
 * @property string $email_reset_token
 * @property string $new_email_request
 * @property string $password_reset_token
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $last_login
 *
 * @property Auth[] $auths
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $avatar;

    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username'], 'trim'],
            [['username'], 'string', 'max' => 100],
            ['avatar_path', 'string'],
            ['avatar_path', 'safe'],
            // имя проверяем на уникальность в базе кроме текукущего (имя не изменили)
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такое имя уже существует.Введите другое', 'when' => function ($model) {
                return $model->username != Yii::$app->user->identity->username;
            }],
            // данная валидация не катит при oAuth авторизации. Там имя может придти с пробелом Вася Пупкин например.
            //И все пипец! метод save() не сработает! Не проходит валидация.Имей в виду!
//            ['username', 'match', 'pattern' => '/^[a-z]\w*$/i', 'message' => 'Имя должно начинаться с буквы и содержать только буквенные символы,числовые символы и знак подчеркивания'],
            [['avatar'], 'file', 'skipOnEmpty' => true, 'extensions' => ['jpeg', 'jpg', 'png', 'gif', 'webp'], 'maxSize' => Yii::$app->params['max_avatar_size'] * 1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя(можно изменить)',
            'email' => 'Email',
            'avatar' => 'Загрузить/изменить аватар',
        ];
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /* Устанавливаем хеш пароля */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /* Проверка на админа */
    public static function isAdmin($username)
    {
        return static::findOne(['username' => $username, 'role' => \app\models\User::ROLE_ADMIN, 'id' => \app\models\User::ADMIN_ID]);
    }
}
