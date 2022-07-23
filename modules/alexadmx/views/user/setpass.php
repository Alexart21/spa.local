<?php
//die('HERE');
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Установка пароля';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<br>
<h3><?= $this->title . ' для пользователя ' . '<span class="text-primary underline">' . $user->username . '</span>' ?></h3>
<div class="pass" style="max-width: 600px">
    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
    <?= $form->field($model, 'password', ['template' => "<div class='form-group'> {input} <span onclick='toggleViz()' class=\"eye fa fa-eye\"></span><div>{error}</div></div>",])->textInput(['oninput' => 'changeInput()', 'autofocus' => true, 'placeholder' => 'новый пароль', 'class' => 'pass-field'])->label(false) ?>
    <?= $form->field($model, 'password_repeat', ['template' => "<div class='form-group'> {input} <span onclick='toggleViz()' class=\"eye fa fa-eye\"></span><div>{error}</div></div>",])->textInput(['oninput' => 'changeInput()', 'placeholder' => 'повторите пароль', 'class' => 'pass-field'])->label(false) ?>
    <div style="display: inline-block">
        кол-во символов&nbsp;&nbsp;<input id="len" type="number" min="6" max="256" value="12"
                                          style="width: 3em !important;">
        <button type="button" class="btn btn-secondary" onclick="generatePass()">генерировать</button>&nbsp;&nbsp;
        &nbsp;&nbsp;<button id="clearBtn" type="button" onclick="clearForm()" style="display: inline;visibility: hidden" class="btn btn-warning">сброс</button>
    </div>
    <br>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Установить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script>
    // переключение видимости кнопки "сброс"
    function changeInput(){
        const fields = document.querySelectorAll('.pass-field');
        const clearBtn = document.getElementById('clearBtn');
        let flag = false;
        let i = 0;
        while (fields[i]) {
           if(fields[i].value){
               flag = true;
           }
            i++;
        }
        if(flag){
            clearBtn.style.visibility = 'visible';
        }else{
            clearBtn.style.visibility = 'hidden';
        }
    }
    //
    function strRand(len) { // случайная строка
        let result = '';
        let words = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM@#$%&';
        let max_position = words.length - 1;
        for (let i = 0; i < len; ++i) {
            let position = Math.floor(Math.random() * max_position);
            result = result + words.substring(position, position + 1);
        }
        return result;
    }
    //
    function generatePass() {
        const len = document.getElementById('len').value;
        const str = strRand(len);
        const fields = document.querySelectorAll('.pass-field');
        let i = 0;
        while (fields[i]) {
            fields[i].value = str;
            i++;
        }
        changeInput();
    }
    // Переключение видимости символов пароля и иконки
    function toggleViz() {
        let fields = document.querySelectorAll('.pass-field');
        let icons = document.querySelectorAll('.eye');
        let i = 0;
        while (fields[i]) {
            if (fields[i].getAttribute('type') === 'text') {
                fields[i].setAttribute('type', 'password');
                icons[i].classList.remove('fa-eye');
                icons[i].classList.add('fa-eye-slash');
            } else {
                fields[i].setAttribute('type', 'text');
                icons[i].classList.remove('fa-eye-slash');
                icons[i].classList.add('fa-eye');
            }
            i++;
        }
    }
    //
    function clearForm(){
        document.forms[0].reset();
        document.getElementById('clearBtn').style.visibility = 'hidden';
    }
</script>
