<?php


namespace app\models\test;


use yii\base\Model;
use Yii;

class TestModel extends Model
{
    public $background_img;
//    public $drag_img;

    public function rules()
    {

        return [
            [['background_img'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg'], 'maxSize' => 5 * 1024 * 1024],
        ];
    }

    public function attributeLabels()
    {
        return [
            'background_img' => 'Фоновое изображение',
//            'drag_img' => 'Накладываемое изображение',
        ];
    }

}