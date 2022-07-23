<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Личный кабинет | '), 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить пароль';
?>
<div class="usr-set site-login">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($passFormModel, 'password', ['enableAjaxValidation' => true, 'template' => "<div class='form-group'> {input} <span class=\"clicked fa fa-eye-slash\"></span><div>{error}</div></div>"])->passwordInput(['class' => 'pass-input', 'placeholder' => 'Ваш пароль']) ?>
    <?= $form->field($passFormModel, 'new_password', ['enableAjaxValidation' => true, 'template' => "<div class='form-group'> {input} <span class=\"clicked fa fa-eye-slash\"></span><div>{error}</div></div>"])->passwordInput(['class' => 'pass-input', 'placeholder' => 'Новый пароль']) ?>
    <?= $form->field($passFormModel, 'new_password_repeat', ['template' => "<div class='form-group'> {input} <span class=\"clicked fa fa-eye-slash\"></span><div>{error}</div></div>"])->passwordInput(['class' => 'pass-input', 'placeholder' => 'Повторите новый пароль']) ?>
    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn success-button']) ?>
<!--        --><?//= Html::a('Забыли пароль?', ['user/request-password-reset'], ['style' => 'display:block;text-align:right']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script>
    window.onload = function(){
        $('#login').modal();
        $('.modal-content').velocity('transition.bounceIn');
    };
</script>
