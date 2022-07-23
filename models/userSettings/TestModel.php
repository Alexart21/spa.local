<?php


namespace app\models\userSettings;


use yii\base\Model;

class TestModel extends Model
{
    public $background_img;
    public $drag_img;

    public function rules()
    {

        return [
            [['background_img', 'drag_img'], 'file'],
            [['background_img', 'drag_img'], 'skipOnEmpty' => true, 'extensions' => ['png']],
        ];
    }
}