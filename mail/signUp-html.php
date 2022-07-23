<?php
use yii\helpers\Html;

$link = Yii::$app->urlManager->createAbsoluteUrl(['user/signup', 'id' =>  $user->id, 'token' => $user->register_token]);
?>
<p>
    Вы зарегистрировались на сайте <?= Yii::$app->name ?> под именем <b style="font-size: 120%"><?= $user->username ?></b>
</p>
<p>
    Ваш пароль: <b style="font-size: 120%"><?= $password ?></b>
</p>
<p>
    Для подтверждения регистрации перенйдите по ссылке  <?= Html::a(Html::encode($link), $link, ['target' => '_blank']) ?>
</p>
<p>
    Ссылка действительна в течении <?= Yii::$app->params['user.registerTokenExpire'] /3600 ?> часа.
</p>
<p>
    (До <?= date("Y-m-d H:i:s", time() + Yii::$app->params['user.registerTokenExpire']) ?> включительно)
</p>
