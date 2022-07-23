<?php

use app\assets\AppAsset;
use yii\helpers\Html;
//use yii\helpers\FileHelper;
header('X-Frame-Options: sameorigin');
header('X-Content-Type-Options: nosniff');
header('X-XSS-Protection: 1;mode=block');
/* При подключении аналитики проверь адреса Content-Security-Policy: script-src */
//header('Content-Security-Policy: default-src \'self\' \'unsafe-inline\' \'unsafe-eval\'; img-src \'self\' data:; style-src \'self\' \'unsafe-inline\'; script-src \'self\' \'unsafe-inline\' *.google.com www.gstatic.com; frame-src *.google.com gstatic.com');
/*header('Permissions-Policy:
    geolocation=(\'none\'),
    camera=(\'none\'),
    microphone=(\'none\')');*/
header('Referrer-Policy: origin-when-cross-origin');
header('Strict-Transport-Security: max-age=31536000');


AppAsset::register($this);

$csrf_param = Yii::$app->request->csrfParam;
$csrf_token = Yii::$app->request->csrfToken;

setcookie('csrf_param', $csrf_param);
setcookie('csrf_token', $csrf_token);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" type="image/png" href="/icons/512x512.png"/>
    <link rel="manifest" href="/manifest.json"/>
    <meta name="msapplication-config" content="/browserconfig.xml"/>
    <meta name="referrer" content="origin"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="HandheldFriendly" content="true">
    <!-- <script src="/js/jquery.min.js"></script> -->
    <!-- <script src="//www.google.com/recaptcha/api.js?render=6LftRl0aAAAAAHJDSCKdThCy1TaS9OwaGNPSgWyC"></script> -->
  <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
