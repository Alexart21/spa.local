<?php
use yii\helpers\FileHelper;

$this->title = 'Административная панель';
?>

<div class="admin-default-index">
    <br>
    <br>
        <a class="btn btn-warning pjax" data-toggle="tooltip" title="очистка кэша" href="/alexadmx/default/cache">очистить кэш</a>&nbsp;
    <a class="btn btn-success pjax" data-toggle="tooltip" title="Установка заголовка LastModified в текущие дату/время" href="/alexadmx/default/last">Last Modified</a>&nbsp;
    <a class="btn btn-success pjax" data-toggle="tooltip" title="Перегенерация файла Sitemap.xml" href="/alexadmx/default/sitemap">Sitemap</a>&nbsp;
    (очистка кэша,установка заголовка LastModified в текущее время,перегенерация sitemap.xml)
    <br>
<!--    --><?php //if ($user === Yii::$app->params['admin_alex']) : ?>
        <h3><a href="/alexadmx/content">Содержимое основных страниц</a> (таблица Content)</h3>
<!--    --><?php //endif; ?>
    <h3><a href="/alexadmx/post">Входящие письма</a></h3>
    <h3><a href="/alexadmx/callback">Заказы обратных звонков</a></h3>
    <h3><a href="/alexadmx/user">Все пользователи</a></h3>
    <a class="btn btn-warning pjax" data-toggle="tooltip" title="Очистка временных папок(Рекомендуется перед бэкапом)" href="/alexadmx/default/clear">Удалить временные файлы</a>
    <br>
    <?php
    $d = dirname(__DIR__);
    $d = str_replace('\\', '/', $d);
    ?>
    <code>Массив с путями к очищаемым папкам: <?= $d ?>/inc/dirArr.php</code>
    <hr>
    <a class="btn btn-primary" href="/alexadmx/default/phpinfo">PHPINFO</a>
</div>
<hr>
<h3>Мини чат</h3>
<a href="/alexadmx/chat" class="btn btn-info">Чат-сохраненные</a>
<a href="/alexadmx/default/chat-clear" class="btn btn-warning pjax">Очистить чат</a>
<hr>
<h3>Резервное копирование</h3>
<a href="/alexadmx/file-backup" class="btn btn-info">Резервные копии файлов</a>
<a href="/alexadmx/db-backup" class="btn btn-info">Сохраненные дампы БД</a>
