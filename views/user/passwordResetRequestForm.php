<?php
//use yii\bootstrap\ActiveForm;
//use yii\bootstrap4\ActiveForm;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Сброс пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login container" style="max-width: 600px">

    <?php if(Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php if(Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin([
        'id' => 'pass-form',
    ]); ?>
    <h3>Укажите Ваш email для сброса пароля</h3>
    <!-- При AJAX валидации рекапча не работает !!! -->
    <?= $form->field($model, 'email')->textInput(['placeholder' => 'E-mail'])->label(false) ?>

    <?= $form->field($model, 'reCaptcha')->widget(
                \himiklab\yii2\recaptcha\ReCaptcha2::class,
                [
                    'siteKey' =>  Yii::$app->params['siteKeyV2'], // unnecessary is reCaptcha component was set up
                ]
            )  ?>

    <br/>
    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn success-button', 'name' => 'login-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>