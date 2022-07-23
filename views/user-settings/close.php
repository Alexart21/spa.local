<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Личный кабинет | '), 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Закрыть аккаунт';
?>
<div class="usr-set site-login">
    <h3>Это действие требует ввода пароля</h3>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($closeFormModel, 'password', ['template' => "<div class='form-group'> {input} <span class=\"clicked fa fa-eye-slash\"></span><div>{error}</div></div>"])->passwordInput(['class' => 'pass-input', 'placeholder' => 'Ваш пароль']) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn success-button']) ?>
<!--        --><?//= Html::a('Забыли пароль?', ['user/request-password-reset'], ['style' => 'display:block;text-align:right']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>