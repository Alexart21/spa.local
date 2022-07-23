<?php
return [
    /* Тестовая отправка письма */
    'gmail_email' => 'iskander.m.211@gmail.com', // куда
    'bk_email' => 'alexart21@bk.ru', // куда
    'sender_email' => 'mail@houme21.ru', // от кого
    /**/
    'siteUrl' =>'alexart.s-solo.ru',
    'protocol' =>'https',
    'company' => 'Alex-art21',
    'email' => 'mail@site.ru',
    'adminEmail' => 'aa@aa.aa', // критично, должно совпадать с тем что в базе
    'supportEmail' => 'robot@site.com',
    'tel1' => '+7(987) 668-04-84',
    'tel1_min' => '+79876680484',
    'tel1_i' => '79876680484',
    'admin' => 'admin_alex',
    'rateLimit' => 10, // попыток входа в минуту. В scripts.js Тоже можно эту цифру (строка )
    /*
        1728000 => 20 суток
        2592000 => 30 суток
        15552000 => 180 суток
    */
    'rememberMeSec' => 2592000, // запомнить в секундах
    'rememberMeDay' => 30, // то же в сутках(показать пользователю)
    'user.passwordResetTokenExpire' => 3600, // время действия ссылки на сброс пароля
    'user.registerTokenExpire' => 3600*24, // время действия ссылки на подтверждение регистрации
    'max_avatar_size' => 512, // макс. размер в килобайтах для аватара
    'max_screenshot_size' => 4, // для скриншота в мегабайтах
    'max_file_count' => 1000, // не позволим мильён файлов загружать
    'min_pass_length' => 6, // минимальная длина пароля
];
