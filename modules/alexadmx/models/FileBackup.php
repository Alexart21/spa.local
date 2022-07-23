<?php

namespace app\modules\alexadmx\models;

use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;


class FileBackup extends Model
{

    public function getFiles($files)
    {
        //кол-во файлов сохраняем для использования в виджете
        Yii::$app->params['count_archive'] = count($files);
        $arr = [];
        foreach ($files as $file) {
            $arr[] = ['file' => $file];
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $arr,
            'sort' => [
                'attributes' => ['file'],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $dataProvider;
    }

    public function delete($path)
    {
        if (file_exists($path)) {
            $path = \yii\helpers\Html::encode($path);
            unlink($path);
            Yii::$app->session->setFlash('success', 'Дамп БД удален.');
        } else {
            Yii::$app->session->setFlash('error', 'Указанный путь не существует.');
        }
        return Yii::$app->response->redirect(['alexadmx/file-backup/index']);
    }

}