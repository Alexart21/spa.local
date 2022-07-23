<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "callback".
 *
 * @property int $id
 * @property string $name
 * @property string $tel
 * @property string $date
 * @property string $is_read
 */
class Callback extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'callback';
    }

    /*public static function primaryKey()
    {
        return 'id';
    }*/

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'tel'], 'required'],
            [['date'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 30],
            ['is_read', 'safe'],
            ['is_read', 'in', 'range' => [0, 1]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'tel' => 'Тел.',
            'date' => 'Дата',
            'is_read' => 'статус(0-новое 1-обработано)',
        ];
    }

    /* Запись в БД */
    public function dbSend($formModel)
    {
        $name = mb_ucfirst(clr_get($formModel->name));
        $tel = clr_get($formModel->tel);

            $this->name = $name;
            $this->tel = $tel;

            $res = $this->save();
            $res = $res ? 'DB_OK!' : 'DB_ERR!';

        return $res;
    }
}
