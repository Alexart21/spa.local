<?php
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/reset-password', 'token' => $user->password_reset_token]);
?>

    Здравствуйте, <?= $user->username ?>,
    Вы или кто-то другой запросили сброс пароля.Перейдите по ссылке для завершения операции:

<?= $resetLink ?>
Ссылка действительна в течении <?= Yii::$app->params['user.passwordResetTokenExpire']/60 ?> минут.
