<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Callback */

$this->title = 'Update Callback: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Callbacks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="callback-update">
    <br>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
