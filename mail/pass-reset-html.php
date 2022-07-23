<?php
use yii\helpers\Html;

$link = Yii::$app->urlManager->createAbsoluteUrl(['user/reset-password', 'id' =>  $user->id, 'token' => $user->password_reset_token]);
?>
<p>
    Вы или кто-то другой запрашивали сброс пароля. Для завершения перейдите по ссылке <?= Html::a(Html::encode($link), $link, ['target' => '_blank']) ?>
</p>
<p>
    Ссылка действительна в течении <?= Yii::$app->params['user.passwordResetTokenExpire']/60 ?> минут.
</p>
