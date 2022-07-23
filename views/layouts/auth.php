<?php

use app\assets\AuthAsset;

//use app\assets\AdminLteAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AuthAsset::register($this);
header('X-Frame-Options: sameorigin');
header('X-Content-Type-Options: nosniff');
header('X-XSS-Protection: 1;mode=block');
/* При подключении аналитики проверь адреса Content-Security-Policy: script-src */
//header('Content-Security-Policy: default-src \'self\' \'unsafe-inline\' \'unsafe-eval\'; img-src \'self\' data:; style-src \'unsafe-inline\' \'unsafe-eval\' \'self\'; script-src \'self\' *.google.com www.gstatic.com \'unsafe-inline\' \'unsafe-eval\'; frame-src *.google.com gstatic.com');
/*header('Permissions-Policy:
    geolocation=(\'none\'),
    camera=(\'none\'),
    microphone=(\'none\')');*/
header('Referrer-Policy: origin-when-cross-origin');
header('Strict-Transport-Security: max-age=31536000');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <!-- <base href="/adminlte/"> -->
    <meta charset="<?= Yii::$app->charset ?>">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="icon" type="image/png" href="/icons/64x64.png"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="HandheldFriendly" content="true">
</head>
<body>
<?php $this->beginBody() ?>
<!-- кликабельный оверлей поверх логотипа -->
<a href="/" title="на главную" class="logo-over">
</a>
<div id="container">
    <div class="breadcrumb-out">
        <?php
        if (!Yii::$app->user->isGuest) :
            ?>
            <b>[<?= Yii::$app->user->identity->username ?>]</b><a href="/user/logout" data-method="post" title="выход"
                                                                  style="margin-left: 3em">
            <i class="fa fa-sign-out-alt"></i>&nbsp;выход</a>
        <?php
        endif;
        ?>
        <?= Breadcrumbs::widget([
            'homeLink' => ['label' => 'Главная | ', 'url' => '/'],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>

    <div class="cont-wrapper">
        <?= $content ?>
    </div>
    <!--<div class="bottom-menu d-flex justify-content-center">
        <div>
            <a href="/" title="на главную"><i class="fa fa-home text-dark"></i></a>
        </div>&nbsp;
        <?php
/*        if (!Yii::$app->user->isGuest) :
            $imgLink = Yii::$app->user->identity->avatar_path ? '/upload/users/usr' . Yii::$app->user->identity->id . '/img/' . Yii::$app->user->identity->avatar_path : '/upload/default_avatar/no-image.png';
            */?>
            <div class="d-flex">
                <div><b>&nbsp;&nbsp;<span class="username text-primary"><?/*= Yii::$app->user->identity->username */?></span>&nbsp;&nbsp;</b></div>
                &nbsp;<div><a href="/user/logout" data-method="post" title="выход"><i
                                class="fa fa-sign-out-alt text-dark"></i></a></div>
            </div>
        <?php
/*        endif;
        */?>
        </a>
    </div>-->
    <br>
    <br>
    <audio preload="auto">
        <source src="/audio/buben.mp3" type="audio/mpeg">
        <source src="/audio/buben.ogg" type="audio/ogg">
    </audio>
    <!--Окно чата-->
    <div id="msg-block" data-closed data-toggle="tooltip" data-trigger="manual"
         title="<?= hello() ?>,я Александр.Чем могу помочь ?">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <div id="msg-content">
            <div class="msg-closed button-anim">
                &nbsp;&nbsp;&nbsp;<i class="fab fa-viber viber"></i> <i class="fab fa-whatsapp wats"></i> <i
                        class="fab fa-telegram-plane tg"></i>
                <b class="msg-closed-text">Начните чат</b>
            </div>
            <img class="msg-img rounded-circle img-thumbnail" src="/img/msg.png" alt="">
            <div class="msg-text">
                <div class="text-center"><?= hello() ?>,я Александр.</div>
                <div class="text-center text-info">выберите мессенджер и начните чат</div>
                <i style="display:block;text-align: right"><span
                            class="fa fa-check"></span><?= date('H:i') ?>&nbsp;&nbsp;</i>
            </div>
            <hr>
            <a class="msg-btn viber-bg" href="viber://chat?number=<?= Yii::$app->params['tel1_i'] ?>"
               target="_blank"><i class="fab fa-viber""></i> Viber</a>
            <a class="msg-btn watsap-bg" href="whatsapp://send?phone=<?= Yii::$app->params['tel1_i'] ?>"
               target="_blank"><i class="fab fa-whatsapp"></i> Watsapp</a>
            <a class="msg-btn tg-bg" href="https://telegram.me/iskander_m21" target="_blank"><i
                        class="fab fa-telegram-plane"></i> Telegram</a>
        </div>
    </div>
    <!--/-->
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
