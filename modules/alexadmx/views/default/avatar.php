<style>
    .modal-content{
        width: 500px !important;
        background: #fff;
    }

    .modal-body{
        display: flex;
        justify-content: center;
        flex-direction: column;
    }

    .modal-content img{
        /*width: 100%;*/
        flex-grow: 0;
        flex-shrink: 0;
        align-items: center;
        display: block;
        box-shadow: -2rem 2rem 2rem rgba(0, 0, 0, 0.2), inset 0 0 30px #ddd;
        border: 1px solid #e61b05;
        border-radius: 3px;
    }

    .modal-header{
        border-bottom-color: transparent !important;
    }

    .modal-header .close{
        transform: scale(2);
    }
</style>
<?php
use yii\bootstrap4\Modal;

Modal::begin([
//    'title' => '<h3>' . $model->username . '</h3><h4 style="float: left">E-mail: ' .  $model->email . '</h4>',
    'id' => 'modal',
]);
?>
<?php
echo '<h2>' . $model->username . '</h2><h4 style="float: left">E-mail: ' . $model->email . '</h4>';
//
$imgPath = $model->avatar_path ? '/upload/users/usr' . $model->id . '/img/avatar/' . $model->avatar_path : '/upload/default_avatar/no-image.png';
?>
<img src="<?= $imgPath ?>" alt="">
<?php
Modal::end();
?>

<script>
    $('#modal').modal();

    // через 4 сек удаляем сообщение
    /*setTimeout(function() {
        $('#modal').modal('hide');
    }, 4000);*/
</script>

