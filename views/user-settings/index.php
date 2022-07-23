<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;

$csrf_param = Yii::$app->request->csrfParam;
$csrf_token = Yii::$app->request->csrfToken;
?>
<style>
    .label {
        cursor: pointer;
    }
    .alert {
        display: none;
    }
    .img-container img {
        max-width: 100%;
    }
    #user-btn{
        visibility: hidden;
    }
    .fade{
        background: rgba(0,0,0,.8);
    }
    .modal-content{
        border: 1px solid #000 !important;
        box-shadow: 0 0 20px #fff;
    }

    #container > div.cont-wrapper > div > div.alert{
        max-width: 20em !important;
    }

    .progress{
        visibility: hidden;
        height: 2em;
        border: 0px solid transparent;
        border-top-left-radius: 1em;
        border-bottom-left-radius: 1em;
        border-top-right-radius: 1em;
        border-bottom-right-radius: 1em;
    }

</style>
</head>
<body>
<div class="site-login">
    <?php
    switch ($model->status){
        case 0 : $status = 'удален';break;
        case 1 : $status = 'не подтвердивший регистрацию';break;
        case 10 : $status = 'активен';break;
        default: $status = 'неизвестен';
    }
    //
    $imgLink = $model->avatar_path ? '/upload/users/usr' . $model->id . '/img/avatar/' . $model->avatar_path : '/upload/default_avatar/no-image.png';
    ?>
    <?php
    $form = ActiveForm::begin();
    ?>
    <h5 style="color: rgba(0,0,0,.3)">Ваш статус: <span style="color: #222"><?= $status ?></span></h5>
    <h5 style="color: rgba(0,0,0,.3)">Email: <span style="color: #222"><?= $model->email ?></span></h5>
    <hr>
    <h4>Имя</h4>
    <?= $form->field($model, 'username', ['enableAjaxValidation' => true])->textInput(['class' => 'd-inline'])->label(false)->error(['style' => 'max-width:300px']) ?>
    <?= Html::submitButton('изменить', ['id' => 'user-btn', 'class' => 'btn btn-primary d-inline']) ?>
    <hr>
    <h4>Аватар</h4>
    <h5>кликните для смены изображения</h5>
    <span style="max-width: 15em;display: block">jpg, png, gif, webp (макс. <?= Yii::$app->params['max_avatar_size'] ?>kb)</span>
    <br>
    <div class="d-flex justify-content-center">
    <label class="label">
        <img class="rounded-circle" id="avatar" style="width: 160px;" src="<?= $imgLink ?>" alt="avatar">
        <?= $form->field($model, 'avatar', ['template' => "{input}{error}",])->fileInput(['class' => 'sr-only', 'id' => 'input', 'accept' => 'image/*'])->label(false) ?>
    </label>
    <?php
    if ($model->avatar_path):
        ?>
        <div class="d-flex flex-column justify-content-end">
            <?= Html::a('удалить', 'user-settings/delete-avatar', ['class' => 'avatar-del align-items-end btn btn-light']) ?>
        </div>
    <?php
    endif;
    ?>
    </div>
    <?php
    ActiveForm::end();
    ?>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true"  data-keyboard="false" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop the image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="image" src="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                    <button type="button" class="btn btn-primary" id="crop">Кадрировать и отправить</button>
                </div>
            </div>
        </div>
    </div>
    <div class="progress">
        <div class="progress-bar progress-bar-striped bg-success"></div>
    </div>
    <br>
    <div class="alert" role="alert"></div>
<!--    <hr class="auth-hr">-->
    <a href="/user-settings/email" class="btn-set">Изменить Email</a>
    <br>
    <a href="/user-settings/pass" class="btn-set">Изменить пароль</a>
    <br>
    <a id="close" class="btn-set" href="/user-settings/close" data-method="post">Закрыть аккаунт</a>
    <br>
    <br>
</div>
<script>
    window.onload = function () {
        let avatar = document.getElementById('avatar');
        let currentSrc = avatar.src;
        let image = document.getElementById('image');
        // let footerIcon = document.querySelector('.avatar-icon');
        // let footerIconSrc = footerIcon.src;
        let input = document.getElementById('input');
        let $alert = $('.alert');
        let $modal = $('#modal');
        let cropper;
        let progressBlock = document.querySelector('.progress');
        let progressBar = document.querySelector('.progress-bar');

        input.addEventListener('change', function (e) {
            let files = e.target.files;
            let done = function (url) {
                input.value = '';
                image.src = url;
                // footerIcon.src = url;
                $alert.hide();
            };
            let reader;
            let file;
            let url;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);// конвертирует Blob в base64 и вызывает onload
                }
                let fileExt = getFileExt(file.name);
                // допустимые расширения
                let res = ['jpg', 'JPG', 'jpeg', 'JPEG', 'gif', 'GIF', 'png', 'PNG', 'webp'].indexOf(fileExt);
                if (res < 0) {
                    $alert.show().addClass('alert-warning').text('Недопустимый тип файла !');
                } else {
                    $modal.modal('show');
                }
            }
        });

        $modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        document.getElementById('crop').addEventListener('click', function () {
            document.body.style.cursor = 'progress';
            let initialAvatarURL;
            let canvas;

            $modal.modal('hide');

            if (cropper) {
                canvas = cropper.getCroppedCanvas({
                    width: 250,
                    height: 250,
                });
                initialAvatarURL = avatar.src;
                avatar.src = canvas.toDataURL();
                $alert.removeClass('alert-success alert-warning');
                canvas.toBlob(function (blob) {
                    let formData = new FormData();
                    formData.append('avatar', blob, 'test.png');
                    formData.append('<?= $csrf_param ?>', '<?= $csrf_token ?>');
                    // console.log(blob.size);
                    if (blob.size > 1024*<?= Yii::$app->params['max_avatar_size'] ?>){
                        $alert.show().addClass('alert-danger').text('Слишком большой файл. Кадрированное изображение не должно превышать <?= Yii::$app->params['max_avatar_size'] ?> кb');
                        return;
                    }
                    // В config/params.php не забудь изменения !!!
                    //url = '<?php //echo Yii::$app->params['protocol'] ?>//://<?php //echo Yii::$app->params['siteUrl'] ?>///user-settings';
                    const url = '/user-settings/avatar';
                    /* Fetch без индикатора загрузки */
                    /*let response = fetch(url, {
                        method: 'POST',
                        body: formData,
                    }).then(function (response) {
                        response.text().then(function (data) {
                            if(response.ok){
                                $alert.show().addClass('alert-success').text('Изображение загружено');
                            }else{
                                let code = response.status;
                                let errText;
                                switch (code) {
                                    case 411 : errText = 'Слишком большой файл';break;
                                    case 415 : errText = 'Не распознан файл изображения';break;
                                    default : '';
                                }
                                $alert.show().addClass('alert-danger').text('Ошибка ' + code + ' ' + errText);
                            }
                        });
                    });*/
                    /* AJAX с прогрессбаром */
                    let xhr = new XMLHttpRequest();
                    xhr.timeout = 20000;

                    xhr.onreadystatechange = () => {
                        if(xhr.readyState == 1) {
                            document.body.style.cursor = 'progress';
                            progressBlock.style.visibility = 'visible';
                            progressBar.classList.add('progress-bar-animated');
                            if (progressBar.classList.contains('bg-danger')){
                                progressBar.classList.remove('bg-danger');
                                progressBar.classList.add('bg-success');
                            }
                            progressBar.innerText = '';
                        }
                    };

                    xhr.upload.onprogress = (e) => {
                        let percentComplete = Math.ceil((e.loaded / e.total) * 100);
                        progressBar.style.width = percentComplete + '%';
                        progressBar.innerText = percentComplete + '%';
                    };

                    // Ждём завершения: неважно, успешного или нет
                    xhr.onloadend = () => {
                        if (xhr.status == 200) {
                            // console.log("Успех");
                            $alert.show().addClass('alert-success').text('Изображение загружено');
                        } else {
                            let code = xhr.status;
                            // console.log("Ошибка " + code);
                            switch (code) {
                                case 413 : errText = 'Слишком большой файл.';break;
                                case 415 : errText = 'Не распознан файл изображения.';break;
                                case 429 : errText = 'Не более <?= Yii::$app->params['rateLimit'] ?> запросов в минуту.';break;
                                default : errText = '';
                            }
                            avatar.src = currentSrc;
                            // footerIcon.src = footerIconSrc;
                            progressBar.classList.remove('bg-success');
                            progressBar.classList.add('bg-danger');
                            progressBar.innerText = 'Ошибка !';
                            $alert.show().addClass('alert-danger').text('Ошибка ' + code + '. ' + errText);
                        }
                        document.body.style.cursor = '';
                        progressBar.classList.remove('progress-bar-animated');
                    };

                    xhr.open('POST', url);
                    xhr.send(formData);
                });
            }
        });
    };

    // получить расширение файла
    function getFileExt(fname) {
        return fname.slice((fname.lastIndexOf(".") - 1 >>> 0) + 2);
    }
    /* Показывать кнопку "изменить имя" только при изменнении инпута */
    const userField = document.getElementById('user-username');
    const userBtn = document.getElementById('user-btn');
    userField.oninput = () => {
        // console.log('update');
        userBtn.style.visibility = 'visible';
    }
</script>