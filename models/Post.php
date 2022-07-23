<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "post".
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $tel
 * @property string $body
 * @property string $date
 * @property string $is_read;
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
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
            [['name', 'email',  'body'], 'required'],
            ['body', 'string'],
            ['date', 'safe'],
            ['name', 'string', 'max' => 100],
            ['email', 'string', 'max' => 255],
            ['tel', 'string', 'max' => 30],
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
            'id' => 'id',
            'name' => 'Имя',
            'email' => 'Email',
            'tel' => 'Teл.',
            'body' => 'Текст',
            'date' => 'Дата',
            'is_read' => 'статус',
        ];
    }

    /* Запись в БД */
    public function dbSave($indexForm)
    {
        /* Санитайзинг номера телефона */
        /*$indexForm->tel = str_replace(')', '', $indexForm->tel);
        $indexForm->tel = str_replace('(', '', $indexForm->tel);
        $indexForm->tel = str_replace('-', '', $indexForm->tel);
        $indexForm->tel = str_replace(' ', '', $indexForm->tel);
        $indexForm->tel = str_replace('+', '', $indexForm->tel);*/

        $transaction = Yii::$app->db->beginTransaction();
        $this->name = mb_ucfirst(clr_get($indexForm->name));
        $this->email = clr_get($indexForm->email);
        $this->tel = clr_get($indexForm->tel);
        $this->body = clr_get($indexForm->text);
        if($this->save()){
           $transaction->commit();
           return 'DB_OK!';
        }else{
            $transaction->rollBack();
            return 'DB_ERR!';
        }
    }
}