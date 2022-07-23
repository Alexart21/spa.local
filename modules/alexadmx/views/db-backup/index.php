<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\FileHelper;

$this->title = 'База данных';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    папка с резервными копиями <code><?= FileHelper::normalizePath(Yii::$app->backup->backupsFolder) ?></code>
    <br>
    <br>
    <p>
        <?= Html::a('Создать дамп БД (экспорт)', ['export'], ['class' => 'btn btn-success']) ?>
        <?php
        if (Yii::$app->params['count_db'] > 1) :
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
                    'attribute' => 'dump',
                    'format' => 'raw',
                    'value' => function($data){
                        return basename($data['dump']);
                    },
                    'label' => 'Файл с дампом БД',
                ],
                [
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Html::a('Импортировать в БД', \yii\helpers\Url::to(['db-backup/import', 'path' => $data['dump']]), ['title' => 'Импортировать', 'class' => 'btn btn-primary']);
                    }
                ],
                [
                    'format' => 'raw',
                    'value' => function ($data, $id) {
                        return Html::a('Скачать', \yii\helpers\Url::to(['db-backup/download', 'path' => $data['dump']]), ['title' => 'Скачать', 'class' => 'btn btn-success']);
                    }
                ],
                [
                    'format' => 'raw',
                    //кнопку удаления выводим только если >1 дампа БД
                    'value' => function ($data, $id) {
                        if (Yii::$app->params['count_db'] > 1) {
                            return Html::a('Удалить', \yii\helpers\Url::to(['db-backup/delete', 'path' => $data['dump']]), ['title' => 'Удалить', 'class' => 'btn btn-danger']);
                        } else return false;
                    }
                ],
            ],
        ]);
        ?>
</div>