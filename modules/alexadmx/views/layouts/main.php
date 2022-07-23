<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;
use yii\bootstrap4\Alert;
use app\assets\AdminLteAsset;
use app\models\User;

AdminLteAsset::register($this);

$user = strtolower(Yii::$app->user->identity->username);
// данные в сессию записаны в родительском контроллере AppAlexadmxController
$session = Yii::$app->session;

$newPostCount = $session->get('newPostCount');
$newCallCount = $session->get('newCallCount');

$allPostCount = $session->get('allPostCount');
$allCallCount = $session->get('allCallCount');

$userCount = $session->get('userCount');
$userCount = $userCount == 1 ? null : $userCount; // админа не считаем

$model = User::findOne(User::ADMIN_ID);
$avatar = $model->avatar_path ? '/upload/users/usr' . $model->id . '/img/avatar/' . $model->avatar_path : '/upload/default_avatar/no-image.png';
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="icon" type="image/png" href="/icons/64x64.png"/>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
    <?php $this->beginBody() ?>
    <!--LOADER-->
    <div id="loader">
        <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             x="0px" y="0px"
             width="70px" height="70px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;"
             xml:space="preserve">
  <path fill="#e61b05"
        d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
      <animateTransform attributeType="xml"
                        attributeName="transform"
                        type="rotate"
                        from="0 25 25"
                        to="360 25 25"
                        dur="0.6s"
                        repeatCount="indefinite"/>
  </path>
  </svg>
    </div>
    <!---->
    <div class="wrapper">
        <!-- Start HEADER -->
        <header class="main-header">

            <?= Html::a('<span class="logo-mini">&copy;</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

            <nav class="navbar navbar-expand-md navbar-light navbar-static-top">
                <!-- Sidebar toggle button
                Отсебятина
                -->
                <style>
                    .sidebar-toggle:before {
                        content: none !important;
                    }
                </style>
                <a href="#" id="left-togle" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <i class="fa fa-align-justify"></i>
                </a>
                <!---->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto py-4 py-md-0">
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <a title="на сайт" class="nav-link" href="/"><i class="fa fa-home"
                                                                            style="font-size: 30px;color: #fff"></i></a>
                        </li>
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <a class="nav-link" href="/alexadmx">главная</a>
                        </li>
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <a class="nav-link" href="/alexadmx/user"><i class="fa fa-user" style="font-size: 30px"></i>
                                <span><?= $userCount ?></span>
                            </a>
                        </li>
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <a class="nav-link" href="/alexadmx/post" data-toggle="tooltip"
                               title="Непрочитанных : <?= $newPostCount ?> Всего : <?= $allPostCount ?>">
                                <i class="fa fa-envelope" style="font-size: 30px"></i>
                                <?php
                                $p = empty($newPostCount) ? null : $newPostCount;
                                ?>
                                <span id="post" class="db-count" style="transform: scale(2)"><?= $p ?></span>
                            </a>
                        </li>
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <a class="nav-link" href="/alexadmx/callback" data-toggle="tooltip"
                               title="Непрочитанных : <?= $newCallCount ?> Всего : <?= $allCallCount ?>">
                                <i class="fa fa-phone" style="font-size: 30px"></i>
                                <?php
                                $c = empty($newCallCount) ? null : $newCallCount;
                                ?>
                                <span id="callback" class="db-count" style="transform: scale(1.5)"><?= $c ?></span>
                            </a>
                        </li>
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <a class="pjax" href="/alexadmx/default/avatar?user=<?= $user ?>">
                                <img id="avatar" class="avatar" src="<?= $avatar ?>">
                            </a>
                        </li>
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <h4 class="nav-link" style="background: #fff;height: 100%"><?= $user ?></h4>
                        </li>
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <a class="nav-link" href="/user/logout" data-method="post"><span title="выйти"
                                                                                             class="fa fa-external-link-alt"></span></a>
                        </li>
                    </ul>
                </div>

            </nav>
        </header>
        <?php Pjax::begin(
            [
                'clientOptions' => [
                    'method' => 'GET',
                    'data-pjax-container' => '#modal',
                ],
                'enablePushState' => false, // не обновлять url
                'linkSelector' => '.pjax', //обрабатывать через pjax только отдельные ссылки
                'timeout' => '20000',
            ]);
        ?>
        <output id="modal"></output>
        <?php Pjax::end(); ?>
        <!-- END HEADER -->
        <!-- START LEFT-SIDEBAR -->
        <aside class="main-sidebar">
            <section class="sidebar">
                <img id="logo" src="/web/img/main_img/logo.png" class="logo-displ">
                <br>
                <a href="/alexadmx/post" title="письма"><span class="fa fa-envelope"></span></a>
                <a href="/alexadmx/callback" title="заказы обратных звонков"><span class="fa fa-phone"></span></a>
                <a href="/alexadmx/default/phpinfo" title="phpinfo"><span class="fab fa-php"></span></a>
            </section>
        </aside>
        <!-- END LEFT-SIDEBAR -->
        <!-- START CONTENT -->
        <div class="content-wrapper">
            <section class="content">
                <section class="content-header">
                    <?= Breadcrumbs::widget([
                        'homeLink' => ['label' => 'Главная', 'url' => '/alexadmx/'],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                </section>
                <!-- Flash сообщения -->
                <?php if (Yii::$app->session->hasFlash('success')): ?>
                    <br>
                    <?= Alert::widget([
                        'options' => [
                            'class' => 'alert-info'
                        ],
                        'body' => Yii::$app->session->getFlash('success'),
                    ]) ?>
                <?php endif; ?>

                <?php if (Yii::$app->session->hasFlash('error')): ?>
                    <br>
                    <?= Alert::widget([
                        'options' => [
                            'class' => 'alert-danger'
                        ],
                        'body' => Yii::$app->session->getFlash('error'),
                    ]) ?>
                <?php endif; ?>
                <!-- Конец Flash сообщения -->
                <div id="main-content">
                    <?= $content ?>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <strong class="company"><?= Yii::$app->params['company'] ?></strong><sup>&copy;</sup> web developer group
            2009&mdash;<?= date('Y') ?> тел. <strong
                    class="corpid"><?= Yii::$app->params['tel1'] ?></strong><br/>
            <strong>Создание и продвижение сайтов в Чебоксарах</strong><br/>
        </footer>
        <aside class="control-sidebar control-sidebar-dark">
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
        </aside>
        <div class='control-sidebar-bg'></div>
        <!-- END CONTENT -->
    </div>
    <?php $this->endBody() ?>
    <script>
        $(document).on('pjax:beforeSend', function () {
            document.body.style.cursor = 'progress';
            $('#loader').css('visibility', 'visible');
        });

        $(document).on('pjax:complete', function () {
            document.body.style.cursor = 'default';
            $('#loader').css('visibility', 'hidden');
        });
        // отсебятина. По клику скрываем лого в левом сайдбаре
        const lbt = document.getElementById('left-togle');
        lbt.onclick = function () {
            const logo = document.getElementById('logo');
            logo.classList.toggle('logo-displ');
        }
        ////
        const alrt = document.querySelector('.alert');
        // console.log(alrt);
        if (alrt) {
            setTimeout(function () {
                alrt.remove();
            }, 4000);
        }
    </script>
    </body>
    </html>
<?php $this->endPage() ?>