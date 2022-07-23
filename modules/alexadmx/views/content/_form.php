<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Url;

mihaildev\elfinder\Assets::noConflict($this);
?>
<style>
    label.control-label{
        font-size: 140%;
        font-weight: bold;
    }
</style>
<div class="content-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Ну и спагетти блин я сделал -->
    <?php if (Yii::$app->requestedAction->id == 'update') : ?>
        <?php if (empty($_GET['visual'])) : ?>
            <b style="font-size: 120%">
                <a href="<?= Url::to('') . '&visual=1' ?>">вкл. визуальный редактор</a>
            </b>

            <?= $form->field($model, 'page')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'title_seo')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>
            <?= $form->field($model, 'last_mod')->textInput(['maxlength' => true, 'value' => time()])
                ->label('Last Modified') ?>


            <?= $form->field($model, 'page_text')->textarea(['rows' => 16]); ?>


        <?php else : ?>
            <b style="font-size: 120%">
                <a href="/alexadmx/content/update?id=<?= $_GET['id'] ?>">в текстовый режим</a>
            </b>


            <?= $form->field($model, 'page')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>
            <?= $form->field($model, 'last_mod')->textInput(['maxlength' => true, 'value' => time()])
                ->label('Last Modified') ?>
            <?= $form->field($model, 'page_text')->widget(CKEditor::class, [
                'editorOptions' => ElFinder::ckeditorOptions('elfinder', [])
            ]); ?>


        <?php endif; ?>
    <?php else : ?>


        <?= $form->field($model, 'page')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>
        <?= $form->field($model, 'last_mod')->textInput(['maxlength' => true, 'value' => time()])
            ->label('Last Modified') ?>
        <?= $form->field($model, 'page_text')->widget(CKEditor::class, [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder', [])
        ]); ?>


    <?php endif; ?>
    <!--/ Ну и спагетти блин я сделал -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Отправить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
