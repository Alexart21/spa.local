<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Личный кабинет | '), 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить Email';
?>
<div class="usr-set site-login">
    <p>Ваш Email: <b><?= Yii::$app->user->identity->email ?></b></p>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($emailFormModel, 'email', ['enableAjaxValidation' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'success-button']) ?>
<!--        --><?//= Html::a('Забыли пароль?', ['user/request-password-reset'], ['style' => 'display:block;text-align:right']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>