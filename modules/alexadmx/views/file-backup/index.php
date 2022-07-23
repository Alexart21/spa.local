<?php
//use Yii;
//var_dump(Yii::$app->backup->backupsFolder);die;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\FileHelper;

$this->title = 'Резервные копии файлов';
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    перечень архивируемых директорий в config/web
    <br>
    папка с резервными копиями <code><?= FileHelper::normalizePath(Yii::$app->backup->backupsFolder) ?></code>
    <br>
    <br>
    <p>
        <?= Html::a('Создать архив', ['create'], ['class' => 'btn btn-success']) ?>
        <?php
        if (Yii::$app->params['count_archive'] > 1) :
        ?>
        <?= Html::a('Удалить все', ['delete-all'], ['class' => 'btn btn-danger']) ?>
        <?php
        endif;
        ?>
        <br>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'file',
                    'format' => 'raw',
                    'value' => function($data){
                        return basename($data['file']);
                    },
                    'label' => 'Файл с архивом',
                ],
                [
                    'format' => 'raw',
                    'value' => function ($data, $id) {
                        return Html::a('Скачать', \yii\helpers\Url::to(['file-backup/download', 'path' => $data['file']]), ['title' => 'Скачать', 'class' => 'btn btn-success']);
                    }
                ],
                [
                    'format' => 'raw',
                    //кнопку удаления выводим только если >1 архива
                    'value' => function ($data, $id) {
                        if (Yii::$app->params['count_archive'] > 1) {
                            return Html::a('Удалить', \yii\helpers\Url::to(['file-backup/delete', 'path' => $data['file']]), ['title' => 'Удалить', 'class' => 'btn btn-danger']);
                        } else return false;
                    }
                ],
            ],
        ]);
        ?>
</div>


