<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\alexadmx\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Входящие письма';
$this->params['breadcrumbs'][] = $this->title;

$session = Yii::$app->session;
?>
<style>
    .glyphicon.glyphicon-pencil {
        display: none;
    }
</style>
<div class="post-index">
    <br>
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    if (!empty($session->get('allPostCount'))) :
    ?>
    <a class="btn btn-danger" href="/alexadmx/post/del_all">Удалить все</a>
    <?php
    endif;
    ?>
    <?php
    if (!empty($session->get('newPostCount'))) :
    ?>
    <a href="/alexadmx/post/postlabel" class="btn btn-dark">Пометить все прочитанными</a>
    <?php
    endif;
    ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'email:email',
            'tel',
            [
                'attribute' => 'body',
                'format' => 'raw',
                'value' => function($model)
                {
                    if (strlen($model->body) > 150){
                        $res = substr($model->body, 0, 150) . ' ...<br>' . '<a class="btn btn-next" href="/alexadmx/post/view?id=' . $model->id . '">читать дальше</a>';
                    }else{
                        $res = $model->body;
                    }
                    return $res;
                }
            ],
//            'date',
            [
                'attribute' => 'date',
                'format' => ['datetime', 'php:d M Y H:i:s'],
            ],
            /*[
                'attribute' => 'date',
                'format' => 'date',
            ],*/
            [
               'attribute' => 'is_read',
                'format' => 'raw',
                'value' => function($model)
                {
                    if($model->is_read == 0){
                        $btn = '<b style="color:green">новое</b>';
                    }else{
                        $btn = '<span style="color:grey">обработано</span>';
                    }

                    return $btn;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'icons' => [
                    'pencil' => '<svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M498 142l-46 46c-5 5-13 5-17 0L324 77c-5-5-5-12 0-17l46-46c19-19 49-19 68 0l60 60c19 19 19 49 0 68zm-214-42L22 362 0 484c-3 16 12 30 28 28l122-22 262-262c5-5 5-13 0-17L301 100c-4-5-12-5-17 0zM124 340c-5-6-5-14 0-20l154-154c6-5 14-5 20 0s5 14 0 20L144 340c-6 5-14 5-20 0zm-36 84h48v36l-64 12-32-31 12-65h36v48z"/></svg>',
                    'trash' => '<svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:.875em;color:red" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0048 48h288a48 48 0 0048-48V128H32zm272-256a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zM432 32H312l-9-19a24 24 0 00-22-13H167a24 24 0 00-22 13l-9 19H16A16 16 0 000 48v32a16 16 0 0016 16h416a16 16 0 0016-16V48a16 16 0 00-16-16z"/></svg>',
                ]
            ],
        ],
    ]); ?>
</div>
<script>
    // выделяем цветом непрочитанные письма и делаем кликабельными
    /*let td = document.getElementsByTagName('td');
    for (i = 0; i < td.length; i++){
        if (td[i].innerText == '0'){
            let id = td[i].parentNode.firstChild.nextSibling.textContent;
            let tr = td[i].parentElement;
            tr.style.background = '#fff';
            tr.style.border = '2px solid #00ff00';
            td[i].style.background = '#7eff91';
            td[i].style.cursor = 'pointer';
            let t = td[i];
            td[i].addEventListener('click', function () { // по клику делаем прочитанным
                read(id, 'post', tr, t);
            });
        }
    }*/
    // хрень чтобы добавить значок "лупы" в поле input
    /*const xx = document.querySelectorAll('input');
    for (let i=0; i<xx.length; i++){
        xx[i].parentNode.style.position = 'relative';
        let s = document.createElement('span');
        s.setAttribute('class', 'fa fa-search');
        s.style.position = 'absolute';
        s.style.right = '20px';
        s.style.top = '22px';
        xx[i].parentNode.appendChild(s);
        //
        xx[i].addEventListener('mouseover', function () {
            s.style.visibility = 'hidden';
        });
        xx[i].addEventListener('mouseout', function () {
            s.style.visibility = 'visible';
        });
    }*/
</script>
