<?php

use yii\helpers\Html;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/reset-password', 'token' => $user->password_reset_token]);
//$resetLink = str_replace('=3D', '=', $resetLink);
?>

<div class="password-reset">
    <p>Здравствуйте, <b><?= Html::encode($user->username) ?></b>>,</p>
    <p>Вы или кто-то другой запросили сброс пароля.Перейдите по ссылке для завершения операции:</p>
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
    <br>
    <p>
    Ссылка действительна в течении <?= Yii::$app->params['user.passwordResetTokenExpire']/60 ?> минут.
    </p>
</div>