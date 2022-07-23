<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap4\Modal;

//use yii\widgets\Spaceless;

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
?>
<?php $this->beginPage() ?>
<?php //Spaceless::begin(); // удаляет пробелы между HTML тегами?>
    <!doctype html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="canonical" href="https://<?= Yii::$app->params['siteUrl'] ?>"/>
        <link rel="icon" type="image/png" href="/icons/512x512.png"/>
        <link rel="manifest" href="/manifest.json"/>
        <meta name="msapplication-config" content="/browserconfig.xml"/>
        <meta name="referrer" content="origin"/>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="HandheldFriendly" content="true">
        <meta name="keywords" content="">
        <?php $this->head() ?>
    <body>
    <?php $this->beginBody() ?>
    <!-- loader -->
    <div id="container_loading">
        <i class="fab fa-osi fa-spin"></i></i>
    </div>
    <!-- end loader -->
    <output id="my-modal"></output>
    <div id="container">
        <?php
        $cookies = Yii::$app->request->cookies;
        $reg_email = $cookies->get('register_confirm');
        ?>
        <?php
        // напоминание о необходимости завершить регистрацию
        if ($reg_email) :
            ?>
            <div class="alert alert-danger fade in alert-dismissible show"
                 style="position: absolute;z-index: 100;width: 100%;transform: scaleY(2)">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                        style="top: .5em;transform: scaleY(0.5)">
                    <span aria-hidden="true" style="font-size:20px;">×</span>
                </button>
                <span style="letter-spacing: 3px"><strong>Внимание!</strong> Для завершения регистрации необходимо пройти по ссылке, высланной Вам на  <b
                            style="text-decoration: underline"><?= $reg_email ?></b></span>
            </div>
        <?php
        endif;
        ?>
        <!--Flash-->
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <?php
            Modal::begin([
//                'title' => '<span class=".h2">Вам выслано письмо</span>',
                'id' => 'success-modal',
            ]);
            echo '<h2 class="text-success">' . Yii::$app->session->getFlash('success') . '</h2>';
            Modal::end();
            ?>
            <!-- "Запуск" модалки в scripts.js -->
        <?php endif; ?>
        <!--end Flash-->
        <!--noindex-->
        <nav id="mobMenu" class="mob-menu-list">
            <strong class="mob-menu-header" title="создание сайтов">Создание сайтов</strong>
            <ul>
                <li class="mob-link"><a class="portf-call" title="сайт визитка" href="/sozdanie#sait_vizitka">сайт
                        визитка</a></li>
                <li class="mob-link"><a class="portf-call" title="корпоративный сайт"
                                        href="/sozdanie#korporativniy_sait">корпоративный
                        сайт</a></li>
                <li class="mob-link"><a class="portf-call" title="интернет магазин" href="/sozdanie#internet_magazin">интернет
                        магазин</a></li>
            </ul>
            <strong class="mob-menu-header" title="продвижение сайтов">Продвижение</strong>
            <ul>
                <li class="mob-link"><a class="portf-call" title="базовая seo оптимизация" href="/prodvijenie#base_seo">базовая
                        оптимизация</a></li>
                <li class="mob-link"><a class="portf-call" title="продвижение по ключевым фразам"
                                        href="/prodvijenie#key_seo">продвижение
                        по фразам</a></li>
                <li class="mob-link"><a class="portf-call" title="контекстная реклама" href="/prodvijenie#context">контекстная
                        реклама</a></li>
            </ul><!--noindex--><strong class="mob-menu-header" title="другие услуги">другие услуги</strong>
            <!--/noindex-->
            <ul>
                <li class="mob-link"><a class="portf-call" title="парсинг сайтов" href="/parsing">парсинг сайтов</a>
                </li>
            </ul>
        </nav>
        <!--/noindex-->
        <div id="main">
            <div id="all">
                <div>
                    <!--обертка -->
                    <!-- тень снизу шапки -->
                    <div id="header_shadow"></div>
                    <!---->
                    <header id="top" class="gradient3" itemscope="" itemtype="http://schema.org/LocalBusiness">

                        <h1 id="top_h">
                            <?php if (isset($this->blocks['h1'])): ?>
                                <?= $this->blocks['h1'] ?>
                            <?php else: ?>
                                Создание и продвижение сайтов
                            <?php endif; ?>
                        </h1>

                        <a href="/">
                            <div id="logo" title="Алекс-арт21 создание и продвижение сайтов">
                                <img class="svg" width="240" height="138"
                                     alt="логотип группы веб разработчиков Алекс-арт21"
                                     src="/img/main_img/logo.png">
                            </div>
                        </a>
                        <div id="right">
                            <div class="right_outer">
                                <ul>
                                    <li title="написать письмо">
                                        <a href="/#contacts" class="mail">mail@alexart21.ru</a>
                                    </li>
                                    <li class="tel">
                                        <span class="pre">тел.</span>
                                        <a href="tel:<?= Yii::$app->params['tel1_min'] ?>" title="позвонить"
                                           itemprop="telephone"><?= Yii::$app->params['tel1'] ?></a>
                                    </li>
                                    <li class="smal" itemprop="openingHours" datetime="Mo-Fr 09:00−18:00">
                                        Пн - Пт 9<sup>00</sup> - 18<sup>00</sup>
                                    </li>
                                </ul>
                                <?php
                                // модальное окно обратного звонка
                                Pjax::begin([
                                    'clientOptions' => [
                                        'method' => 'get',
                                        'url' => '/call',
                                        'container' => '#my-modal',
                                    ],
                                    'enablePushState' => false, // не обновлять url
                                    'linkSelector' => '.call',
                                    'timeout' => '20000',

                                ]);
                                ?>
                                <div class="call-btn"
                                     title="заказать обратный звонок">
                                    <a rel="nofollow" class="call pulse-button" href="/call">обратный звонок</a>
                                </div>
                                <?php Pjax::end(); ?>
                            </div>
                        </div>
                        <div id="center">
                            <div>
				<span itemprop="name"> <strong>Алекс-арт21</strong>
					<span>группа веб-разработчиков</span>
					<span itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
						<span itemprop="addressLocality">г. Чебоксары</span>
					</span>
				</span>
                            </div>
                            <output class="shtorka gradient3"></output>
                        </div>
                        <!--noindex-->
                        <noscript>
                            Для полнофункционального отображения страницы включите JAVA SCRIPT !
                        </noscript>
                        <!--/noindex-->
                    </header>
                </div>
                <?php
                // AJAX страницы в основной контент
                Pjax::begin([
                    'clientOptions' => [
                        'method' => 'get',
//                                    'url' => '/call',
                        'container' => '#inc',
                        'scrollOffset' => 0,
                    ],
                    'enablePushState' => true, // обновлять url
                    'linkSelector' => '.portf-call',
                    'timeout' => '20000',
                ]);
                ?>
                <div id="menu_outer">
                    <div id="top_menu">
                        <div class="menu_shadow main-menu">
                            <nav class="resp">
                                <ul class="menutop  highlightTextIn">
                                    <li><a class="portf-call" data-m="главная" href="/" title="">главная</a></li>
                                    <li><a class="portf-call" data-m="создание сайтов" href="/sozdanie"
                                           title="создание сайтов">создание
                                            сайтов</a></li>
                                    <li><a class="portf-call" data-m="продвижение" href="/prodvijenie"
                                           title="продвижение сайтов">продвижение</a>
                                    </li>
                                    <li>
                                        <a class="portf-call" data-m="портфолио"
                                           href="/portfolio"
                                           title="">портфолио</a>
                                    </li>
                                    <li><a data-m="контакты"
                                           href="/#contacts" title="">контакты</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <?php
                Pjax::end();
                ?>
                <div id="block">
                    <!-- начало левый блок -->
                    <div id="left">
                        <!-- начало "мобильное" левое меню -->
                        <!--noindex-->
                        <div class="mob-menu-col">
                            <div class="mob-menu-button" title="меню"></div>
                        </div>
                        <!--/noindex-->
                        <!-- конец "мобильное" левое меню -->
                        <!-- начало "десктопное" левое меню -->
                        <nav id="l_menu">
                            <a class="l_header link-anim portf-call" href="/sozdanie" title="создание сайтов">Создание
                                сайтов</a>
                            <ul>
                                <li class="left_gr2"><a class="portf-call" title="сайт визитка"
                                                        href="/sozdanie#sait_vizitka">сайт
                                        визитка</a></li>
                                <li class="left_gr2"><a class="portf-call" title="корпоративный сайт"
                                                        href="/sozdanie#korporativniy_sait">корпоративный сайт</a>
                                </li>
                                <li class="left_gr2"><a class="portf-call" title="интернет магазин"
                                                        href="/sozdanie#internet_magazin">интернет
                                        магазин</a></li>
                            </ul>
                            <br/>
                            <a class="l_header link-anim portf-call" href="/prodvijenie" title="продвижение сайтов">Продвижение
                                сайтов</a>
                            <ul>
                                <li class="left_gr2"><a class="portf-call" title="базовая seo оптимизация"
                                                        href="/prodvijenie#base_seo">базовая оптимизация</a></li>
                                <li class="left_gr2"><a class="portf-call" title="продвижение по ключевым фразам"
                                                        href="/prodvijenie#key_seo">продвижение по фразам</a></li>
                                <li class="left_gr2"><a class="portf-call" title="контекстная реклама"
                                                        href="/prodvijenie#context">контекстная
                                        реклама</a></li>
                            </ul>
                            <br/><!--noindex--><strong class="l_header">Другие услуги</strong><!--/noindex-->
                            <br/>
                            <ul>
                                <li class="left_gr2"><a class="portf-call" title="парсинг сайтов" href="/parsing">парсинг
                                        сайтов</a>
                                </li>
                            </ul>
                        </nav>
                        <!-- конец "десктопное" левое меню -->
                    </div>
                    <!-- конец левый блок -->
                    <!-- начало основной контент -->
                    <div class="inc-out">
                        <main id="inc">
                            <?php echo $content ?>
                        </main>
                        <div id="inc-overlay"></div>
                    </div>
                    <!-- конец основной контент -->
                </div>
                <!--кнопка вверх-->
                <div id="scroller" class="fa fa-chevron-circle-up" title="проскролить вверх"></div>
                <!--/-->
                <audio preload="auto">
                    <source src="/audio/buben.mp3" type="audio/mpeg">
                    <source src="/audio/buben.ogg" type="audio/ogg">
                </audio>
                <!--Окно чата-->
                <div id="msg-block" data-closed data-toggle="tooltip" data-trigger="manual"
                     title="<?= hello() ?>,я Александр.Чем могу помочь ?">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <div id="msg-content">
                        <div class="msg-closed button-anim">
                            &nbsp;&nbsp;&nbsp;<i class="fab fa-viber viber"></i> <i class="fab fa-whatsapp wats"></i> <i
                                    class="fab fa-telegram-plane tg"></i>
                            <b class="msg-closed-text">Начните чат</b>
                        </div>
                        <img class="msg-img rounded-circle img-thumbnail" src="/img/msg.png" alt="">
                        <div class="msg-text">
                            <div class="text-center"><?= hello() ?>,я Александр.</div>
                            <div class="text-center text-info">выберите мессенджер и начните чат</div>
                            <i style="display:block;text-align: right"><span
                                        class="fa fa-check"></span><?= date('H:i') ?>&nbsp;&nbsp;</i>
                        </div>
                        <hr>
                        <a class="msg-btn viber-bg" href="viber://chat?number=<?= Yii::$app->params['tel1_i'] ?>"
                           target="_blank"><i class="fab fa-viber""></i> Viber</a>
                        <a class="msg-btn watsap-bg" href="whatsapp://send?phone=<?= Yii::$app->params['tel1_i'] ?>"
                           target="_blank"><i class="fab fa-whatsapp"></i> Watsapp</a>
                        <a class="msg-btn tg-bg" href="https://telegram.me/iskander_m21" target="_blank"><i
                                    class="fab fa-telegram-plane"></i> Telegram</a>
                    </div>
                </div>
                <!--/-->
            </div>
        </div>
        <!--noindex-->
        <div style="width:100%;height:10px"></div>
        <footer class="innerShadow gradient3">
            <strong class="company">Alex-art21</strong><sup>&copy;</sup> web developer group 2009&mdash;<?= date('Y') ?>
            тел. <b
                    class="corpid"><?= Yii::$app->params['tel1'] ?></b><br/>
            <strong>Создание и продвижение сайтов в Чебоксарах</strong><br/>
            <span>Ваши персональные данные могут обрабатывается только в соответствии с
                        <a href="/politic"
                           style="position: relative;z-index: 100">ФЗ «О персональных данных» № 152-ФЗ</a></span>
            <br><small style="position: relative;z-index: 100">Этот сайт защищен Google reCAPTCHA в соответствии с
                <a href="https://policies.google.com/privacy">политикой конфиденциальности</a> и
                <a href="https://policies.google.com/terms">условиями применения</a>.
            </small>
            <br>
            <div class="d-flex justify-content-center user-block">
                <?php
                if (Yii::$app->user->isGuest) :
                    ?>
                    <div><div class="no-avatar"></div></div>&nbsp;&nbsp;&nbsp;
                    <div><a class="text-dark" href="/user/login">вход</a></div>&nbsp;&nbsp;
                    <div><a class="text-dark" href="/user/signup">регистрация</a></div>
                <?php
                else:
                    $avatar = Yii::$app->user->identity->avatar_path ? '/upload/users/usr' . Yii::$app->user->identity->getId() . '/img/avatar/' . Yii::$app->user->identity->avatar_path : '/upload/default_avatar/no-image.png';
                    ?>&nbsp;
                    <div><a href="/user-settings" title="личный кабинет"><img src="<?= $avatar ?>" alt="" class="avatar rounded-circle img-thumbnail"></a></div>
                    &nbsp;&nbsp;<div class="username"><a href="/user-settings" title="личный кабинет" class="text-dark"><?= Yii::$app->user->identity->username ?></a></div>
                    &nbsp;&nbsp;
                    <div>&nbsp;&nbsp;<a href="/user/logout" data-method="post"><span title="выйти"
                                                                         class="fa fa-external-link-alt"></span></a></div>
                <?php
                endif;
                ?>
            </div>
        </footer>
        <!--/noindex-->
    </div>
    <?php $this->endBody() ?>
    <!--    <script type="application/javascript" src="//cdn.callbackhunter.com/cbh.js?hunter_code=d82e7609836e952210721f77d740e85b" charset="UTF-8" async="true"></script>-->
    </body>
    </html>
<?php //Spaceless::end()?>
<?php $this->endPage() ?>