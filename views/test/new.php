<?php
//die;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Тестовое задание';
// фон пришел синхронно
if (!$bg_src) {
    $bg_src = '/img/test/img1.png';
}
?>
<main class="container">
    <h3 style="margin-bottom: 2em">Добавьте изображение(*.png) и(или) текст </h3>
    <div class="d-flex justify-content-between">
        <div class="left">
            <input id="imgInput" type="file" onchange="readFile(this, '#img2')" style="display: none">
            <div id="img-container">
                <div class="btn-block">
                    <div id="allAdd" type="button" class="add-bt" onclick="allAdd()">
                        <div class="text-call">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            <!--                            <span>Обратная<br>связь</span>-->
                        </div>
                    </div>
                    <i class="rBt" id="imgBtn" onclick="imgAdd(imgInput)"></i>
                    <i class="rBt" id="textBtn" onclick="textAdd('#contenteditable')"
                       title="Справа сразу вводите текст"></i>
                </div>
                <img class="resize-image" src="" alt="" id="img2">
                <div id="contenteditable" class="contenteditable" draggable="true"></div>
            </div>
        </div>
        <div class="right" style="margin-left: 1em">
            <div class="img-control">
<!--                <div class="img-block-over"></div>-->
                <div style="width: 10em">
                    <b>Поворот картинки</b>
                    <div class="d-flex justify-content-between">
                        <div>-180</div>
                        <div>0</div>
                        <div>180</div>
                    </div>
                    <input style="width: 10em" class="image-rotate" type="range" name="rangeInput" min="-180" max="180"
                           value="0">
                </div>
                <h5>Изменить фон(*.jpg, *.png)</h5>
                <?php
                $form = ActiveForm::begin([
                    'id' => 'bg-form',
                ])
                ?>

                <?= $form->field($model, 'background_img')->fileInput(['id' => 'file-input', 'accept' => 'image/*'])->label(false); ?>
                <? //= Html::submitButton('отправить', ['id' => 'submit-btn', 'class' => 'btn btn-success']) ?>

                <?php
                ActiveForm::end();
                ?>
            </div>
            <hr>
            <div class="text-control">
                <b>Здесь ваш текст</b>
                <input class="my-input" name="inner_text" type="text" id="innerText" value="" placeholder="Ваш текст">
                <br>
                <br>
                <b>Выберите шрифт</b>
                <br>
                <select id="font" class="select">
                    <option style="font-family: Arial" value="Arial">Arial</option>
                    <option style="font-family: comic sans ms" value="comic sans ms">Comic Sans MS</option>
                    <option style="font-family: segoe script" value="segoe script">Segoe Script</option>
                </select>
                <br>
                <br>
                <b>Размер (px)</b>
                <br>
                <input id="fontSize" type="number" min="1" max="300" value="24">
                <br>
                <br>
                <b>Цвет</b>
                <br>
                <input id="color" value="rgba(175,180,255,1)" data-jscolor="{
		position: 'right', width: 181, height: 121,
		palette: '#fff #fcd #fdc #ffc #dfc #dff #cdf #dcf #ccc', paletteCols: 9, paletteHeight: 25,
		padding: 10, sliderSize: 25, borderRadius: 5,
		borderWidth: 0, controlBorderWidth: 1, pointerBorderWidth: 2,
		borderColor: '#000', controlBorderColor: '#AAA', backgroundColor: '#F3F3F3', shadowColor: 'rgba(0,0,0,.4)',
		closeButton: true, closeText: 'OK', buttonColor: '#333',
	}">
                <br>
                <br>
                <b>Интервал (px)</b>
                <br>
                <input id="letSps" type="number" value="1">
            </div>
            <br>
            <br>
            <div class="main-block">
                <button id="clear-btn" class="btn btn-danger"><i class="fa fa-trash"> </i>Очистить все</button>
                <button id="export-btn" class="btn btn-success">Сохранить</button>
            </div>
        </div>
    </div>
</main>
<hr>
<h5>Ссылка на github: <a href="https://github.com/Alexart21/yii2.redis" target="_blank">https://github.com/Alexart21/yii2.redis</a>
</h5>
<h5>Подробнее в файле README.md на GitHub</h5>
