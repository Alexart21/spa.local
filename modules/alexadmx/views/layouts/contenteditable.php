<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminContentEditableAsset;

AdminContentEditableAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <meta name="robots" content="robots.txt">
        <title>Админка | <?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
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
    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => 'Powered by <span style="text-shadow: 1px 1px red">Mihalych21</span>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand navbar-dark bg-dark',
            ],
        ]);
        ?>
        <span class="user"
              style="color: #000;background: #fff;line-height: 50px;text-transform: uppercase;float: right;margin-left: 1em;padding: 0 1em"><?= Yii::$app->user->identity->username ?></span>

        <?php
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'на сайт', 'url' => ['/']],
                ['label' => 'главная', 'url' => ['/alexadmx']],
                ['label' => 'выйти', 'url' => ['/site/logout'], 'linkOptions' => ['data' => ['method' => 'post']]], // разлогиниваем админа
            ],

        ]);
        NavBar::end();
        ?>
        <div class="container">
            <br>
            <br>
            <br>
            <?= $content ?>
            <div>
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
        </div>
    </div>
    <?php $this->endBody() ?>
    <script>
        //
        // анимация загрузки
        function loading() {
            document.body.style.cursor = 'progress';
            loader.style.visibility = 'visible';
        }
        // стоп анимации
        function loading_stop() {
            document.body.style.cursor = "";
            loader.style.visibility = '';
        }
        /* AJAX */
        // отправка контента в режиме редактирования contenteditable
        // content объект с данными {content': 'ghjgjjj'}
        function form_call(content, id) {
            $.ajax({
                type: 'POST',
                url: '/alexadmx/content/update?id=' + id + '&contenteditable=1',
                data: content,
                success: function (res) {
                    // alert(res);
                    $('#result').html(res);
                },
                error: function (xhr, str) {
                    alert('Возникла ошибка: ' + xhr.responseCode);
                },
                cache: false,
                beforeSend: function () {
                    loading();
                },
                complete: function () {
                    loading_stop();
                    $('#result').css('display', 'block');
                    $('body,html').animate({scrollTop: 0}, 400);
                }
            });
        }
        ///
        $('#edit_but').on('click', function () {
            const page_text = {
                page_text: $('.contenteditable').html()
            };
            form_call(page_text, <?= (int)$_GET['id'] ?>);
        });
        ////
        $(document).on('pjax:beforeSend', function () {
            document.body.style.cursor = 'progress';
        });
        $(document).on('pjax:complete', function () {
            document.body.style.cursor = 'default';
        });
    </script>
    </body>
    </html>
<?php $this->endPage() ?>