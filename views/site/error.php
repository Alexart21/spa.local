<?php
use yii\helpers\Html;
use Yii;
$this->title = $name;
// шаблон здесь
$this->context->layout = 'error';
$statusCode = Yii::$app->response->getStatusCode(); ?>
<div class="site-error">

    <h1 style="text-align: center"><?= Html::encode($this->title) ?></h1>

    <div>
        <h2 style="color: #000;text-shadow: .5px .5px red;letter-spacing: 1px;text-align: center"><span><?= nl2br(Html::encode($message)) ?></span></h2>
        <?php
        if($statusCode == 429) :
        ?>
        <div id="timer-block" style="text-align: center;font-weight: bold;font-size: 120%">Повторите попытку через <span id="timer" style="color: red"></span> с.</div>
        <?php
        endif;
        ?>
    </div>
</div>
<!-- Таймер обратного отсчета(Только при превышении лимита запросов) -->
<?php
if ($statusCode == 429) :
?>
    <script>
        let time = 60;
        let timer = document.getElementById('timer');
        const clock = function(){
            time--;
            timer.innerText = time;
        };

        timer.innerText = time;
        let timerId = setInterval(clock, 1000);
        setTimeout(() => {clearInterval(timerId);document.getElementById('timer-block').innerHTML = '<a href="/login">Повторить попытку</a>';}, time*1000);
    </script>
<?php
endif;
?>
