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
//header('Content-Security-Policy: default-src \'self\' \'unsafe-inline\' \'unsafe-eval\';');
header('Permissions-Policy: camera=(), display-capture=(), geolocation=(), microphone=()');
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
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
