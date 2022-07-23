<h3>Исправленная версия <a href="https://alexart.houme21.ru/test/new">здесь</a></h3>
<p><a href="/user/logout" data-method="post">logout</a></p>
<?php
die;
//var_dump($path);die;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Тестовое задание';
// фон пришел синхронно
if(!$bg_src){
    $bg_src = '/img/test/img1.png';
}
?>
<main class="container">
    <h1>Тестовое задание</h1>
    <h3>Позиционируйте внутреннюю картинку в пределах красной рамки перетаскиванием</h3>
    <h3>Для загрузки своей картинки кликните по ней или перетащите файл в синюю рамку</h3>
    <h3>Все отменить "Сброс"</h3>
    <div id="img-container">
<!--        <img src="/img/test/img1.png" alt="" id="img2">-->
        <div class="drop-zone">
        <img src="/img/test/img2.png" alt="" id="img2" draggable="true">
            <span class="drop-zone__prompt"></span>
            <input type="file" name="myFile" class="drop-zone__input">
        </div>
    </div>
    <br>
    <h5>Фоновое изображение(*.jpg, *.png)</h5>
    <?php
    $form = ActiveForm::begin([
        'id' => 'bg-form',
    ])
    ?>

    <?= $form->field($model, 'background_img')->fileInput(['id' => 'file-input', 'accept' => 'image/*'])->label(false); ?>
    <?//= Html::submitButton('отправить', ['id' => 'submit-btn', 'class' => 'btn btn-success']) ?>

    <?php
    ActiveForm::end();
    ?>
    <hr>
    <h5>Размер внутреннего изображения</h5>
    сохранять пропорции
    <input id="zoom" type="checkbox" name="zoom" checked>
    <br>
    ширина
    <input id="width" type="number">
    высота
    <input id="height" type="number">
    <button id="scale-btn" class="btn btn-secondary" title="не забудь нажать" data-toggle="tooltip" data-trigger="manual">Применить</button>
    <br>
    <h5>Поворот в градусах по часовой<br>(можно отрицательные значения)</h5>
    <input id="rotate" type="number" value="90">
    <button id="rotate-btn" class="btn btn-secondary" title="не забудь нажать" data-toggle="tooltip" data-trigger="manual">применить</button><br><br>
    <hr>
    <button id="clear-btn" class="btn btn-danger">Сброс</button>
    <button id="export-btn" class="btn btn-success">Скачать результат</button>
</main>
<hr>
<h5>Ссылка на github: <a href="https://github.com/Alexart21/yii2.redis" target="_blank">https://github.com/Alexart21/yii2.redis</a></h5>
<h5>Подробнее в файле README.md на GitHub</h5>
