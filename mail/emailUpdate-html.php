<?php
use yii\helpers\Html;

$link = Yii::$app->urlManager->createAbsoluteUrl(['user-settings/email', 'id' =>  $user->id, 'token' => $user->email_reset_token]);
?>
<p>
    Вы зарегистрированы на сайте <?= Yii::$app->name ?> под именем <b style="font-size: 120%"><?= $user->username ?></b>
</p>

<p>
    Для подтверждения смены Email перенйдите по ссылке  <?= Html::a(Html::encode($link), $link, ['target' => '_blank']) ?>
</p>
<p>
    Ссылка действительна в течении <?= Yii::$app->params['user.registerTokenExpire'] /3600 ?> часа.
</p>
