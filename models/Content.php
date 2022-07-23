<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Content extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page', 'page_text'], 'required'],
            [['page_text'], 'string'],
            [['page'], 'string', 'max' => 255],
            [['page'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page' => 'Page',
            'content' => 'Content',
        ];
    }

    /**
     * @return string
     */
    public function getContent()
    {
        // имя экшена
        $act = Yii::$app->requestedAction->id;
        // дергаем кэш (Redis or FileCache)
        $data = Yii::$app->cache->get($act);
        if ($data) {
            return $data;
        }
        /* SQL + ActiveRecord */
        /*$sql = "SELECT * FROM content WHERE page = '$act'";
        $data = ActiveRecord::findBySql($sql)->asArray()->all();
        $data = $data[0];*/

        /* ActivRecord + подготовленный запрос */
//        $data = self::find()->where('page=:act', [':act' => $act])->limit(1)->asArray()->one();
        /* ActivRecord*/
        $data = self::find()->where(['page' => $act])->limit(1)->asArray()->one();
        /* Хранимая процедура */
        /*$sql = "CALL getContent('$act')";
        $data = ActiveRecord::findBySql($sql)->asArray()->all();
        $data = $data[0];*/

//        debug($data['title_seo']);die;

        // set cache
        // 86400 - сутки
        // 604800 - неделя
        // 18144000 - 30 дней
        //15552000 - 180 суток
//        Yii::$app->cache->set($act, $data, 15552000);
        Yii::$app->cache->set($act, $data); // "навечно" закешировали
        return $data;
    }
}
