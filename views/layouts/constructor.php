<?php

use app\assets\ConstructorAsset;
use yii\helpers\Html;
use yii\helpers\FileHelper;

ConstructorAsset::register($this);

$bgDir = FileHelper::normalizePath(Yii::getAlias('@vue_assets') . '/img/'); // здесь файлы с фонами
$bgFiles = FileHelper::findFiles($bgDir);
$i = 0;
$bgArr = [];
foreach ($bgFiles as $file) {
  $arr = getimagesize($file);
  $width = $arr[0];
  $height = $arr[1];
  $mime = $arr['mime'];
  $name = explode('.', pathinfo($file)['filename'])[0];
  $ext = pathinfo($file)['extension'];
  $fullName = $name . '.' . $ext;
  //
  $bgArr[$i]['width'] = $width;
  $bgArr[$i]['height'] = $height;
  $bgArr[$i]['fullName'] = $fullName;
  $bgArr[$i]['name'] = $name;
  $bgArr[$i]['mime'] = $mime;
  $isAct = ($name === 'black') ? 1 : 0; // первую картинку делаем активной по умолчанию
  $bgArr[$i]['isActive'] = $isAct;
  $i++;
}
//debug($bgArr);die;
//
$csrf_param = Yii::$app->request->csrfParam;
$csrf_token = Yii::$app->request->csrfToken;

setcookie('bg', json_encode($bgArr));
setcookie('csrf_param', $csrf_param);
setcookie('csrf_token', $csrf_token);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <base href="/vue_assets/">
    <meta charset="<?= Yii::$app->charset ?>">
  <?= Html::csrfMetaTags() ?>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title><?= Html::encode($this->title) ?></title>
    <!--    <script src="/js/vue/vue.global.prod.js"></script>-->
    <!--    <script src="/js/vue/Vue3DraggableResizable.umd.min.js"></script>-->
  <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
