<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use app\modules\alexadmx\controllers\UserController;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\alexadmx\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Все пользователи');
$this->params['breadcrumbs'][] = $this->title;

//$model = $dataProvider->getModels(); // пока не понял откуда приходит $model
//var_dump($model);
?>
<style>
    #w1-success{
        margin-top: 80px;
    }
</style>
<br>
<br>
<h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<p>
    <?= Html::a(Yii::t('app', 'Добавить пользователя'), ['create'], ['class' => 'btn btn-success']) ?>

    <?php
    if (UserController::isUnregister()) :
        ?>
        <a class="btn btn-secondary" href="/alexadmx/user/unregister?UserSearch[status]=<?= User::STATUS_REQUEST ?>">Не подтвердившие регистрацию</a>
    <?php
    endif;
    ?>

    <?php
    if (UserController::isDeleted()) :
        ?>
        <a class="btn btn-dark" href="/alexadmx/user/deleted?UserSearch[status]=<?= User::STATUS_DELETED ?>">Удаленные</a>
    <?php
    endif;
    ?>
</p>
<?php
//die('HERE');
//var_dump($dataProvider);
?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'username',
        'email:email',
        'role',
        [
            'attribute' => 'status',
            'format' => 'raw',
            'value' => function($model)
            {
                $btn = $model->status;
                if($model->role != User::ROLE_ADMIN){ // кроме админа
                    if ($model->status == 1){
                        $btn .= '<br><a href="/alexadmx/user/set-deleted?id=' . $model->id . '" class="btn btn-danger" style="transform: scale(.8);text-wrap: none">пометить удаленным</a>
                                    <br><a href="/alexadmx/user/set-active?id=' . $model->id . '" class="btn btn-success" style="transform: scale(.8);text-wrap: none">сделать активным</a>';
                    }elseif ($model->status == 0){
                        $btn .= '<br><a href="/alexadmx/user/set-active?id=' . $model->id . '" class="btn btn-success" style="transform: scale(.8);text-wrap: none">сделать активным</a>';
                    }elseif ($model->status == 10){
                        $btn .= '<br><a href="/alexadmx/user/set-deleted?id=' . $model->id . '" class="btn btn-danger" style="transform: scale(.8);text-wrap: none">пометить удаленным</a>';
                    }
                    return $btn;
                }else{
                    return $model->status;
                }

            }

        ],
//            'auth_key',
        //'register_token:ntext',
        //'password_reset_token:ntext',
        [
            'attribute' => 'created_at',
            'format' => ['datetime', 'php:d M Y H:i:s'],
        ],
        [
            'attribute' => 'updated_at',
            'format' => ['datetime', 'php:d M Y H:i:s'],
        ],
        [
            'attribute' => 'last_login',
            'format' => ['datetime', 'php:d M Y H:i:s'],
        ],
        [
            'attribute' => 'password',
            'format' => 'raw',
            'value' => function($model)
            {
                if($model->role != User::ROLE_ADMIN) { // кроме админа
                    return '<a href="/alexadmx/user/setpass?id=' . $model->id . '" class="btn btn-warning" style="transform: scale(.8);text-wrap: none">изменить пароль</a>';
                }else{
                    return 'недоступно';
                }
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'icons' => [
                'trash' => '<svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:.875em;color:red" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0048 48h288a48 48 0 0048-48V128H32zm272-256a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zM432 32H312l-9-19a24 24 0 00-22-13H167a24 24 0 00-22 13l-9 19H16A16 16 0 000 48v32a16 16 0 0016 16h416a16 16 0 0016-16V48a16 16 0 00-16-16z"/></svg>',
            ]
        ],
    ],
]); ?>
</div>