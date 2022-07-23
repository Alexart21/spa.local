<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login container" style="max-width: 600px">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin([
        'id' => 'form-signup',
    ]);
    ?>
    <!--    <fieldset>-->
    <!-- При включенной AJAX валидации google reCaptcha выдает ошибку!!! выбирай... -->
    <?php //echo $form->field($model, 'username', ['enableAjaxValidation' => true])->textInput(['autofocus' => true, 'placeholder' => 'Имя'])->label(false)->error(['style' => 'max-width:300px']) ?>
    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Имя'])->label(false)->error(['style' => 'max-width:300px']) ?>
    <?php //echo $form->field($model, 'email', ['enableAjaxValidation' => true])->textInput(['placeholder' => 'email'])->label(false) ?>
    <?= $form->field($model, 'email')->textInput(['placeholder' => 'email'])->label(false) ?>
    <?php //echo $form->field($model, 'password', ['enableAjaxValidation' => true, 'template' => "<div class='form-group'> {input} <span class=\"clicked fa fa-eye-slash\"></span><div>{error}</div></div>",])->passwordInput(['class' => 'pass-input', 'placeholder' => 'пароль'])->label(false) ?>
    <?= $form->field($model, 'password', ['template' => "<div class='form-group'> {input} <span class=\"clicked fa fa-eye-slash\"></span><div>{error}</div></div>",])->passwordInput(['class' => 'pass-input', 'placeholder' => 'пароль'])->label(false) ?>
    <?= $form->field($model, 'password_repeat', ['template' => "<div class='form-group'> {input} <span class=\"clicked fa fa-eye-slash\"></span><div>{error}</div></div>",])->passwordInput(['class' => 'pass-input', 'placeholder' => 'пароль еще раз'])->label(false) ?>
    <!--            --><?php //echo $form->field($model,'avatar')->fileInput()  ?>
    <!--<h3>Аватар</h3>
    <div class="drop-zone">
        <span class="drop-zone__prompt"><span class="fa fa-cloud-download-alt"></span><br>Кликните или перетащите файл<br><b>(jpg,tif,png,gif)</b></span>
        <?php /*echo $form->field($model, 'avatar')->fileInput(['class' => 'drop-zone__input'])->label(false) */?>
    </div>
    <br>-->
    <?php /*echo $form->field($model, 'reCaptcha')->widget(
        \himiklab\yii2\recaptcha\ReCaptcha2::class,
        [
            'siteKey' =>  Yii::$app->params['siteKeyV2'], // unnecessary is reCaptcha component was set up
        ]
    ) */?>

    <?php /*echo \himiklab\yii2\recaptcha\ReCaptcha3::widget([
                'name' => 'reCaptcha',
                'siteKey' => '6LfNdr4ZAAAAAIKLdnRzRCWwNM6HyP0qo0nYglbN', // unnecessary is reCaptcha component was set up
                'action' => 'signup',
            ]) */ ?>
    <br>
    <br>
    <?= Html::submitButton('Отправить', ['class' => 'btn success-button', 'name' => 'signup-button', 'style' => 'margin-top:-50px']) ?>
    <!--    </fieldset>-->
    <?php ActiveForm::end(); ?>
    <div class="auth-hr"></div>
    <h3>Или войти с помощью</h3>
    <?= yii\authclient\widgets\AuthChoice::widget([
        'baseAuthUrl' => ['site/auth'],
        'popupMode' => false,
    ]);
    ?>
</div>
<script>
    window.onload = function () {
        $('#login').modal();
        $('.modal-content').velocity('transition.bounceIn');
    };
</script>