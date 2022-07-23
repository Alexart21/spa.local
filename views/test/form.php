<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\test\TestForm */
/* @var $form ActiveForm */
?>
<div class="test-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($testForm, 'username') ?>
        <?= $form->field($testForm, 'email') ?>
        <?= $form->field($testForm, 'password') ?>
        <?= $form->field($testForm, 'password_repeat') ?>
        <?= $form->field($testForm, 'reCaptcha') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- test-form -->
