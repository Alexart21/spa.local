<?php

namespace app\modules\alexadmx\controllers;

use Yii;
use yii\helpers\FileHelper;
use app\modules\alexadmx\models\DbBackup;


class DbBackupController extends AppAlexadmxController
{
    //Путь к файлам БД по-умолчанию
//    public $dumpPath = __DIR__ . '/../../../../backups';

    public function actionIndex($path = null)
    {
        //Получаем массива путей к файлам с дампом БД (.sql)
        // путь к папке из config/web components->backup
        $path = FileHelper::normalizePath(Yii::$app->backup->backupsFolder);
        $files = FileHelper::findFiles($path, ['only' => ['*.sql'], 'recursive' => FALSE]);
        $model = new DbBackup();
        //Метод формирует массив в нужный для виджета GridView формат с пагинацией
        $dataProvider = $model->getFiles($files);
//        var_dump($dataProvider);die;
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionImport($path)
    {
        $model = new DbBackup();
        //Метод делает импорт дампа БД
        $model->import($path);
    }

    public function actionExport($path = null)
    {
//        $path = $path ?: $this->dumpPath;
        $path = $path ?: Yii::$app->backup->backupsFolder;
        $model = new DbBackup();
        //Метод экспортирует данные из БД в указанную папку
        $model->export($path);
    }

    public function actionDelete($path)
    {
        $model = new DbBackup();
        //Метод удаляет дамп БД
        $model->delete($path);
    }

    public function actionDeleteAll()
    {
        $path = FileHelper::normalizePath(Yii::$app->backup->backupsFolder);
        $arr = FileHelper::findFiles($path, ['only' => ['*.sql'], 'recursive' => FALSE]);
//        var_dump($arr);die;
        foreach ($arr as $file){
            unlink($file);
        }
        return Yii::$app->response->redirect(['alexadmx/db-backup/index']);
    }

    public function actionDownload($path)
    {
        if (file_exists($path)) {
            return \Yii::$app->response->sendFile($path);
        }
        throw new \Exception('File not found');
    }
}