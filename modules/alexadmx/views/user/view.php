<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;
//use yii\bootstrap4\Alert;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Пользователь "' . $model->username . '" id:' . $model->id;
\yii\web\YiiAsset::register($this);
?>
<style>
    #w1-success{
        margin-top: 80px;
    }
</style>
<br>
<?php
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs']['homeLink'] = ['label' => 'Главная', 'url' => '/alexadmx/'];
?>
<div>
    <?/*= Breadcrumbs::widget([
        'homeLink' => ['label' => 'Главная', 'url' => '/alexadmx/'],
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) */?>
</div>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Изменить'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <a class="btn btn-warning" href="/alexadmx/user/setpass?id=<?= $model->id ?>">Установить пароль</a>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы точно хотите удалить данного пользователя?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
            'role',
            'password_hash',
            'auth_key',
            'register_token:ntext',
            'password_reset_token:ntext',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
