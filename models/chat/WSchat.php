<?php

namespace app\models\chat;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property string $ip
 * @property string $created_at
 * @property string $color
 */
class WSchat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wschat';
    }

    const MSG_LIMIT = 200; // кол-во выводимых записей

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'text'], 'required'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 40],
            [['text'], 'string', 'max' => 1024],
            [['ip'], 'string', 'max' => 50],
            [['color'], 'string', 'max' => 7],
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
            'ip' => 'Ip',
            'created_at' => 'Created At',
            'color' => 'Color',
        ];
    }

    public static function getMessages()
    {
        return static::find()->orderBy('id DESC')->limit(self::MSG_LIMIT)->all();
    }
}
