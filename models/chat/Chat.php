<?php

namespace app\models\chat;

use Yii;
//use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "chat".
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property int $ip
 * @property string $created_at
 * @property string $color
 */
class Chat extends \yii\db\ActiveRecord
{
    const MSG_LIMIT = 200; // кол-во выводимых записей

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat';
    }

    /*public static function primaryKey()
    {
        return 'id';
    }*/

    /*public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }*/

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'text'], 'required'],
            [['text'], 'string'],
            [['color'], 'string', 'max' => 7],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['ip'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'text' => 'Text',
            'created_at' => 'Created At',
//            'color' => 'Color',
        ];
    }

    public static function getMessages()
    {
        return static::find()->orderBy('id DESC')->limit(self::MSG_LIMIT)->all();
    }
}
