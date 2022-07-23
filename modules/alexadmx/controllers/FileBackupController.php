<?php
namespace app\modules\alexadmx\controllers;

use Yii;
use yii\helpers\FileHelper;
use app\modules\alexadmx\models\FileBackup;

class FileBackupController extends AppAlexadmxController
{
    //Путь к файлам по-умолчанию
//    public $backupPath = __DIR__ . '/../../../../backups';

    public function actionIndex($path = null)
    {
        //Получаем массива путей к файлам с дампом БД (.sql)
        // путь к папке из config/web components->backup
        $path = FileHelper::normalizePath(Yii::$app->backup->backupsFolder);
        $files = FileHelper::findFiles($path, ['only' => ['*.tar'], 'recursive' => FALSE]);
//        var_dump($files);die;
        $model = new FileBackup();
        //Метод формирует массив в нужный для виджета GridView формат с пагинацией
        $dataProvider = $model->getFiles($files);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        set_time_limit(600);
        $backup = Yii::$app->backup;
        $result = $backup->create();
        return Yii::$app->response->redirect(['alexadmx/file-backup/index']);
    }

    public function actionDownload($path)
    {
        if (file_exists($path)) {
            return \Yii::$app->response->sendFile($path);
        }
        throw new \Exception('File not found');
    }

    public function actionDelete($path)
    {
        $model = new FileBackup();
        $model->delete($path);
    }

    public function actionDeleteAll()
    {
        $path = FileHelper::normalizePath(Yii::$app->backup->backupsFolder);
        $arr = FileHelper::findFiles($path, ['only' => ['*.tar'], 'recursive' => FALSE]);
//        var_dump($arr);die;
        foreach ($arr as $file){
            unlink($file);
        }
        return Yii::$app->response->redirect(['alexadmx/file-backup/index']);
    }
}