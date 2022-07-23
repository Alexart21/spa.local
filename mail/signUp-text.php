<?php
$link = Yii::$app->urlManager->createAbsoluteUrl(['user/signup', 'id' =>  $user->id, 'token' => $user->register_token]);
use yii\helpers\Html;
?>
    Вы зарегистрировались на сайте <?= Yii::$app->name ?> под именем <b style="font-size: 120%"><?= $user->username ?></b>
    Ваш пароль: <b style="font-size: 120%"><?= $password ?></b>
    Для подтверждения регистрации перенйдите по ссылке  <?= Html::a(Html::encode($link), $link, ['target' => '_blank']) ?>
    Ссылка действительна в течении <?= Yii::$app->params['user.registerTokenExpire'] /3600 ?> часа.

